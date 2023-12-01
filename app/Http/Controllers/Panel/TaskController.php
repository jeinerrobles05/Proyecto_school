<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\GroupStudent;
use App\Models\Task;
use App\course_group;
use App\Models\Reward;
use App\Models\RewardAccounting;
use App\Models\Role;
use App\Models\Translation\TaskTranslation;
use App\Models\WebinarChapter;
use App\Models\WebinarChapterItem;
use App\Models\NotificationTemplate;
use App\User;
use App\Models\Webinar;
use App\Models\TasksResult;
use App\Models\TasksQuestion;
use App\Models\TasksQuestionsAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $allTasksLists = Task::select('id', 'webinar_id')
            ->where('creator_id', $user->id)
            ->where('status', 'active')
            ->get();

        $allGroupsLists = Task::select('id', 'group_id', 'webinar_id')
            ->where('creator_id', $user->id)
            ->where('status', 'active')
            ->get();


        $query = Task::where('creator_id', $user->id);

        $webinars = Task::select('webinar_id')
            ->where('creator_id', $user->id)
            ->where('status', 'active')
            ->distinct()
            ->get();

        $tasksCount = deepClone($query)->count();

        $webinarCount = deepClone($webinars)->count();

        $taskFilters = $this->filters($request, $query);

        $tasks = $taskFilters->with([
            'webinar',
            'taskResults',
        ])->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $userSuccessRate = [];
        $userCount = 0;

        foreach ($tasks as $task) {

            $countSuccess = $task->taskResults
                ->where('status', \App\Models\TasksResult::$passed)
                ->pluck('user_id')
                ->count();

            $rate = 0;
            if ($countSuccess) {
                $rate = round($countSuccess / $task->taskResults->count() * 100);
            }

            $task->userSuccessRate = $rate;

            $userCount += $task->taskResults
                ->pluck('user_id')
                ->count();
        }

        $data = [
            'pageTitle' => trans('task.tasks_list_page_title'),
            'tasks' => $tasks,
            'userSuccessRate' => $userSuccessRate,
            'webinarCount' => $webinarCount,
            'tasksCount' => $tasksCount,
            'userCount' => $userCount,
            'allTasksLists' => $allTasksLists,
            'allGroupsLists' => $allGroupsLists
        ];

        return view(getTemplate() . '.panel.tasks.lists', $data);
    }

    public function filters(Request $request, $query)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $task_id = $request->get('task_id');
        $group_id = $request->get('group_id');
        $total_mark = $request->get('total_mark');
        $status = $request->get('status');
        $active_tasks = $request->get('active_tasks');


        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($task_id) and $task_id != 'all') {
            $query->where('id', $task_id);
        }

        if (!empty($group_id) and $group_id != 'all') {
            $query->where('group_id', $group_id);
        }

        if ($status and $status !== 'all') {
            $query->where('status', strtolower($status));
        }

        if (!empty($active_tasks)) {
            $query->where('status', 'active');
        }

        if ($total_mark) {
            $query->where('total_mark', '>=', $total_mark);
        }

        return $query;
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        $webinars = Webinar::where(function ($query) use ($user) {
            $query->where('teacher_id', $user->id)
                ->orWhere('creator_id', $user->id);
        })->get();

        // Obtener grupos basados en el usuario y el curso
        $courseId = $request->input('course_id'); // Asegúrate de tener el campo correcto según tu implementación


        $groups = course_group::where(function ($query) use ($user) {
            $query->where('instructor_id', $user->id)
                ->orWhere('curso_id', 2031);
        })->get();

        $locale = $request->get('locale', app()->getLocale());

        $data = [
            'pageTitle' => trans('task.new_task_page_title'),
            'webinars' => $webinars,
           // 'groups' => $groups,
            'userLanguages' => getUserLanguagesLists(),
            'locale' => mb_strtolower($locale),
            'defaultLocale' => getDefaultLocale(),
        ];

        return view(getTemplate() . '.panel.tasks.create', $data);
    }

    public function getAllByWebinarId($webinar_id)
    {
        $user = auth()->user();

        $webinar = Webinar::find($webinar_id);

        if (!empty($webinar) and $webinar->canAccess($user)) {

            $groups = $webinar->groups->where('curso_id', $webinar_id );

            $data = [
                'groups' => [],
            ];

            if (!empty($groups) and count($groups)) {
                // for translate send on array of data

                foreach ($groups as $group) {
                    $data['groups'][] = [
                        'name' => $group->name,
                        'curso_id' => $group->curso_id,
                        'id' => $group->id,
                        'instructor_id' => $group->instructor_id,
                    ];
                }
            }

            return response()->json($data, 200);
        }

        abort(403);
    }
    public function store(Request $request)
    {
        $data = $request->get('ajax')['new'];
        $locale = $data['locale'] ?? getDefaultLocale();

        $rules = [
            'title' => 'required|max:255',
            'webinar_id' => 'required',
            'group_id' => 'required',
            'expiry_days' => 'required|date_format:Y-m-d\TH:i',
            'description' => 'required|min:2',
            'attach' => 'nullable|string',
        ];

        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validate->errors()
            ], 422);
        }

        $user = auth()->user();

        $webinar = null;
        $group = null;
        if (!empty($data['webinar_id'])) {
            $webinar = Webinar::where('id', $data['webinar_id'])
                ->where(function ($query) use ($user) {
                    $query->where('teacher_id', $user->id)
                        ->orWhere('creator_id', $user->id);
                })->first();

            if (!empty($webinar) and !empty($data['group_id'])) {
                $group = course_group::where('id', $data['group_id'])
                    ->where('curso_id', $webinar->id)
                    ->first();
            }
        }

        $task = Task::create([
            'webinar_id' => !empty($webinar) ? $webinar->id : $data['webinar_id'],
            'group_id' => $data['group_id'],//!empty($group) ? $group->id : 0,
            'creator_id' => $user->id,
            'attempt' => $data['attempt'] ?? null,
            'pass_mark' => 3.0,
            'description' => $data['description'] ?? null,
            'attach' => $data['attach'] ?? null,
            'status' => (!empty($data['status']) and $data['status'] == 'on') ? Task::ACTIVE : Task::INACTIVE,
            'expiry_days' => (!empty($data['expiry_days'])) ? strtotime($data['expiry_days']) : null,
            'created_at' => time(),
        ]);

        if (!empty($task)) {
            TaskTranslation::updateOrCreate([
                'task_id' => $task->id,
                'locale' => mb_strtolower($locale),
            ], [
                'title' => $data['title'],
            ]);
        }

        // Send Notification To All Students
        if (!empty($webinar)) {

            $notificationTemplate = NotificationTemplate::where('title', 'New task added to course')->first();

            $webinar->sendNotificationToAllStudentsForNewTaskPublished($task, $notificationTemplate->id);
        }

        if ($request->ajax()) {

            $redirectUrl = '';

            if (empty($data['is_webinar_page'])) {
                $redirectUrl = '/panel/tasks/' . $task->id . '/edit';
            }

            return response()->json([
                'code' => 200,
                'redirect_url' => $redirectUrl
            ]);
        } else {
            return redirect()->route('panel_edit_task', ['id' => $task->id]);
        }
    }

    public function edit(Request $request, $id)
    {
        $user = auth()->user();
        $webinars = Webinar::where(function ($query) use ($user) {
            $query->where('teacher_id', $user->id)
                ->orWhere('creator_id', $user->id);
        })->get();

        $webinarIds = $webinars->pluck('id')->toArray();

        $task = Task::where('id', $id)
            ->where('creator_id', $user->id)
            ->where(function ($query) use ($user, $webinarIds) {
                $query->where('creator_id', $user->id);
                $query->orWhereIn('webinar_id', $webinarIds);
            })
            ->first();

        $groups = course_group::where('instructor_id', $user->id)
            ->where('curso_id', $task->webinar_id)
            ->get();

        if (!empty($task)) {

            $locale = $request->get('locale', app()->getLocale());

            $data = [
                'pageTitle' => trans('public.edit') . ' ' . $task->title,
                'webinars' => $webinars,
                'groups' => $groups,
                'task' => $task,
                'userLanguages' => getUserLanguagesLists(),
                'locale' => mb_strtolower($locale),
                'defaultLocale' => getDefaultLocale(),
            ];

            return view(getTemplate() . '.panel.tasks.create', $data);
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $webinar = null;
        if (!empty($data['webinar_id'])) {
            $webinar = Webinar::where('id', $data['webinar_id'])
                ->where(function ($query) use ($user) {
                    $query->where('teacher_id', $user->id)
                        ->orWhere('creator_id', $user->id);
                })->first();
        }


        $task = Task::query()->where('id', $id)
            ->where(function ($query) use ($user, $webinar) {
                $query->where('creator_id', $user->id);

                if (!empty($webinar)) {
                    $query->orWhere('webinar_id', $webinar->id);
                }
            })
            ->first();

        if (!empty($task)) {

            $data = $request->get('ajax')[$id];
            //$group = $request->input('group_id');
            $locale = $data['locale'] ?? getDefaultLocale();

            $rules = [
                'title' => 'required|max:255',
                'webinar_id' => 'nullable',
                'group_id' => 'required',
                'description' => 'required|string|min:1',
                'attach' => 'nullable|string',
            ];

            $validate = Validator::make($data, $rules);

            if ($validate->fails()) {
                return response()->json([
                    'code' => 422,
                    'errors' => $validate->errors()
                ], 422);
            }

            $task->update([
                'webinar_id' => !empty($webinar) ? $webinar->id : $data['webinar_id'],
                'attempt' => $data['attempt'] ?? null,
                'pass_mark' => 3.0,
                'description' => $data['description'] ?? null,
                'attach' => $data['attach'] ?? null,
                'status' => (!empty($data['status']) and $data['status'] == 'on') ? Task::ACTIVE : Task::INACTIVE,
                'expiry_days' => (!empty($data['expiry_days'])) ? strtotime($data['expiry_days']) : null,
                'updated_at' => time(),
                'group_id' => $data['group_id'],
            ]);


            TaskTranslation::updateOrCreate([
                'task_id' => $task->id,
                'locale' => mb_strtolower($data['locale']),
            ], [
                'title' => $data['title'],
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'code' => 200
                ]);
            } else {
                return redirect('panel/tasks');
            }
        }

        abort(404);
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->user();
        $task = Task::where('id', $id)
            ->first();

        if (!empty($task)) {

            $webinar = null;
            if (!empty($task->webinar_id)) {
                $webinar = Webinar::query()->find($task->webinar_id);
            }

            if ($task->creator_id == $user->id or (!empty($webinar) and $webinar->canAccess($user))) {
                if ($task->delete()) {
                    return response()->json([
                        'code' => 200
                    ], 200);
                }
            }
        }

        return response()->json([], 422);
    }

    public function start(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();

        // Obtener el grupo asociado a la tarea
        $taskGroupId = $task->group_id;

        $user = auth()->user();

        // Verificar si el estudiante está asociado al mismo grupo que la tarea
        $isAssociated = GroupStudent::where('user_id', $user->id)
            ->where('group_id', $taskGroupId)
            ->exists();

        if (!$isAssociated) {
            // El estudiante no está asociado al mismo grupo que la tarea
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => trans('cart.not_available'),
                'status' => 'error'
            ];

            return back()->with(['toast' => $toastData]);
        }

        if ($task) {

            if (!empty($task->webinar_id)) {
                $webinar = $task->webinar;

                $checkUserHasBought = $webinar->checkUserHasBought($user);

                if (!$checkUserHasBought) {
                    $toastData = [
                        'title' => trans('public.request_failed'),
                        'msg' => trans('cart.you_not_purchased_this_course'),
                        'status' => 'error'
                    ];
                    return back()->with(['toast' => $toastData]);
                }

                if (!empty($task->expiry_days)) {
                    $hasAccess = false;
                    $sale = $webinar->getSaleItem($user);

                    $currentTimestamp = time();
                    $expiryTimestamp = $task->expiry_days;

                    if (!empty($sale)) {
                        if ($expiryTimestamp >= $currentTimestamp) {
                            $hasAccess = true;
                        }
                    }

                    if (!$hasAccess) {
                        $toastData = [
                            'title' => trans('public.request_failed'),
                            'msg' => trans('update.your_access_to_this_task_has_been_expired'),
                            'status' => 'error'
                        ];
                        return back()->with(['toast' => $toastData]);
                    }
                }
            }

            $userTaskDone = TasksResult::where('task_id', $task->id)
                ->where('user_id', $user->id)
                ->get();

            $status_pass = false;
            foreach ($userTaskDone as $result) {
                if ($result->status == TasksResult::$passed) {
                    $status_pass = true;
                }
            }

            if (!isset($task->attempt) or ($userTaskDone->count() < $task->attempt and !$status_pass)) {


                $data = [
                    'pageTitle' => trans('task.task_start'),
                    'task' => $task,
                    'attempt_count' => $userTaskDone->count() + 1,
                ];

                return view(getTemplate() . '.panel.tasks.start', $data);
            } else {
                $toastData = [
                    'title' => trans('public.request_failed'),
                    'msg' => trans('task.cant_start_task'),
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }
        abort(404);
    }

    public function tasksStoreResult(Request $request, $id)
    {
        // Buscar la tarea resuelta con el ID proporcionado
        $taskResult = TasksResult::where('task_id', $id)->first();

        if ($taskResult) {
            // Se encontró una tarea resuelta, muestra el mensaje de error
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => trans('update.this_task_has_been_answered'),
                'status' => 'error'
            ];

            return back()->with(['toast' => $toastData]);
        }

        $user = auth()->user();
        $task = Task::where('id', $id)->first();

        if (!empty($task->expiry_days)) {
            $hasAccess = false;

            $currentTimestamp = time();
            $expiryTimestamp = $task->expiry_days;

            if ($expiryTimestamp >= $currentTimestamp) {
                $hasAccess = true;
            }

            if (!$hasAccess) {
                $toastData = [
                    'title' => trans('public.request_failed'),
                    'msg' => trans('update.your_access_to_this_task_has_been_expired'),
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }

        $this->validate($request, [
            'answer' => 'required|min:2',
        ]);

        $data = $request->all();

        $totalMark = 0;
        $status = 'waiting';

        if ($request->hasFile('uploaded_file')) {
            $uploadedFile = $request->file('uploaded_file');

            // Generar la ruta de almacenamiento
            $path = '/store/' . $user->id . '/' . $uploadedFile->getClientOriginalName();

            // Almacenar el archivo en el sistema de archivos
            $uploadedFile->storeAs('/' . $user->id, $uploadedFile->getClientOriginalName(), 'public');
        } else {
            $path = null;
        }

        $newTaskStart = TasksResult::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'results' => $data['answer'],
            'attach' => $path,
            'user_grade' => $totalMark,
            'status' => $status,
            'created_at' => time()
        ]);

        $notifyOptions = [
            '[c.title]' => $task->webinar ? $task->webinar->title : '-',
            '[student.name]' => $user->full_name,
            '[t.title]' => $task->title,
        ];
        $notificationTemplate = NotificationTemplate::where('title', 'Waiting task')->first();

        sendNotificationTask($notificationTemplate->id, $notifyOptions, $task->creator_id);

        return redirect()->route('task_status', ['taskResultId' => $newTaskStart]);

        abort(404);
    }

    public function status($taskResultId)
    {
        $user = auth()->user();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->where('user_id', $user->id)
            ->first();

        if ($taskResult) {
            $task = $taskResult->task;
            $attemptCount = $task->attempt;

            $userTaskDone = TasksResult::where('task_id', $task->id)
                ->where('user_id', $user->id)
                ->count();

            $canTryAgain = false;
            if ($userTaskDone < $attemptCount) {
                $canTryAgain = true;
            }

            $data = [
                'pageTitle' => trans('task.task_status'),
                'taskResult' => $taskResult,
                'task' => $task,
                'attempt_count' => $userTaskDone,
                'canTryAgain' => $canTryAgain,
            ];

            return view(getTemplate() . '.panel.tasks.status', $data);
        }
        abort(404);
    }

    public function myResults(Request $request)
    {
        $user = auth()->user();

        $webinarIds = $user->getPurchasedCoursesIds();
        $userGroupIds = GroupStudent::where('user_id', $user->id)->pluck('group_id');
        $query = TasksResult::where('user_id', auth()->user()->id);


        $taskResultsCount = deepClone($query)->count();
        $passedCount = deepClone($query)->where('status', \App\Models\TasksResult::$passed)->count();
        $failedCount = deepClone($query)->where('status', \App\Models\TasksResult::$failed)->count();
        $waitingCount = deepClone($query)->where('status', \App\Models\TasksResult::$waiting)->count();

        $allTasksWebinars = Task::whereIn('group_id', $userGroupIds)
            ->whereIn('webinar_id', $webinarIds)
            ->where('status', 'active')
            ->whereHas('taskResults', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        $allInstructorsIds = Webinar::whereIn('id', $webinarIds)
            ->pluck('teacher_id')
            ->toArray();

        $allInstructors = User::whereIn('id', $allInstructorsIds)
            ->pluck('full_name', 'id')
            ->toArray();

        $query = $this->resultFilters($request, deepClone($query));

        $taskResults = $query->with([
            'task' => function ($query) {
                $query->with(['creator', 'webinar']);
            }
        ])->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($taskResults->groupBy('task_id') as $task_id => $taskResult) {
            $canTryAgainTask = false;

            $result = $taskResult->first();
            $task = $result->task;

            if (!isset($task->attempt) or (count($taskResult) < $task->attempt and $result->status !== 'passed')) {
                $canTryAgainTask = true;
            }

            foreach ($taskResult as $item) {
                $item->can_try = $canTryAgainTask;
                if ($canTryAgainTask and isset($task->attempt)) {
                    $item->count_can_try = $task->attempt - count($taskResult);
                }
            }
        }

        $data = [
            'pageTitle' => trans('task.my_results'),
            'tasksResults' => $taskResults,
            'tasksResultsCount' => $taskResultsCount,
            'passedCount' => $passedCount,
            'failedCount' => $failedCount,
            'waitingCount' => $waitingCount,
            'allTasksWebinars' => $allTasksWebinars,
            'allInstructors' => $allInstructors
        ];

        return view(getTemplate() . '.panel.tasks.my_results', $data);
    }

    public function opens(Request $request)
    {
        $user = auth()->user();

        $webinarIds = $user->getPurchasedCoursesIds();

        $userGroupIds = GroupStudent::where('user_id', $user->id)->pluck('group_id');

        $query = Task::whereIn('group_id', $userGroupIds)
            ->whereIn('webinar_id', $webinarIds)
            ->where('status', 'active')
            ->whereDoesntHave('taskResults', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

        $allTasksWebinars = Task::whereIn('group_id', $userGroupIds)
            ->whereIn('webinar_id', $webinarIds)
            ->where('status', 'active')
            ->whereDoesntHave('taskResults', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        $allInstructorsIds = Webinar::whereIn('id', $webinarIds)
            ->pluck('teacher_id')
            ->toArray();

        $allInstructors = User::whereIn('id', $allInstructorsIds)
            ->pluck('full_name', 'id')
            ->toArray();

        $query = $this->resultFiltersOpens($request, deepClone($query));

        $tasks = $query->orderBy('created_at', 'desc')
            ->paginate(5);

        $data = [
            'pageTitle' => trans('task.open_tasks'),
            'tasks' => $tasks,
            'allTasksWebinars' => $allTasksWebinars,
            'allInstructors' => $allInstructors
        ];

        return view(getTemplate() . '.panel.tasks.opens', $data);
    }

    public function results(Request $request)
    {
        $user = auth()->user();

        if (!$user->isUser()) {
            $tasks = Task::where('creator_id', $user->id)
                ->where('status', 'active')
                ->get();

            $tasksIds = $tasks->pluck('id')->toArray();

            $query = TasksResult::whereIn('task_id', $tasksIds);

            $studentsIds = $query->pluck('user_id')->toArray();
            $allStudents = User::select('id', 'full_name')->whereIn('id', $studentsIds)->get();

            $taskResultsCount = $query->count();
            $taskAvgGrad = round($query->avg('user_grade'), 2);
            $waitingCount = deepClone($query)->where('status', \App\Models\TasksResult::$waiting)->count();
            $passedCount = deepClone($query)->where('status', \App\Models\TasksResult::$passed)->count();
            $successRate = ($taskResultsCount > 0) ? round($passedCount / $taskResultsCount * 100) : 0;

            $query = $this->resultFilters($request, deepClone($query));

            $tasksResults = $query->with([
                'task' => function ($query) {
                    $query->with(['creator', 'webinar']);
                }, 'user'
            ])->orderBy('created_at', 'desc')
                ->paginate(10);

            $data = [
                'pageTitle' => trans('task.results'),
                'tasksResults' => $tasksResults,
                'taskResultsCount' => $taskResultsCount,
                'successRate' => $successRate,
                'taskAvgGrad' => $taskAvgGrad,
                'waitingCount' => $waitingCount,
                'tasks' => $tasks,
                'allStudents' => $allStudents
            ];

            return view(getTemplate() . '.panel.tasks.results', $data);
        }

        abort(404);
    }

    public function resultFilters(Request $request, $query)
    {
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $task_id = $request->get('task_id', null);
        $group_id = $request->get('group_id', null);
        $total_mark = $request->get('total_mark', null);
        $status = $request->get('status', null);
        $user_id = $request->get('user_id', null);
        $instructorMyResult = $request->get('instructorMyResult', null);
        $open_results = $request->get('open_results', null);

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($task_id) and $task_id != 'all') {
            $query->where('task_id', $task_id);
        }

        if (!empty($group_id) and $group_id != 'all') {
            $query->whereHas('task', function ($taskQuery) use ($group_id) {
                $taskQuery->where('group_id', $group_id);
            });
        }

        if ($total_mark) {
            $query->where('total_mark', $total_mark);
        }

        if (!empty($user_id) and $user_id != 'all') {
            $query->where('user_id', $user_id);
        }

        if (!empty($instructorMyResult) and $instructorMyResult != 'all') {
            $query->whereHas('task.creator', function ($taskQuery) use ($instructorMyResult) {
                $taskQuery->where('id', $instructorMyResult);
            });
        }

        if ($status and $status != 'all') {
            $query->where('status', strtolower($status));
        }

        if (!empty($open_results)) {
            $query->where('status', 'waiting');
        }

        return $query;
    }

    public function resultFiltersOpens(Request $request, $query)
    {
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $task_id = $request->get('task_id', null);
        $total_mark = $request->get('total_mark', null);
        $status = $request->get('status', null);
        $user_id = $request->get('user_id', null);
        $instructor = $request->get('instructor', null);
        $open_results = $request->get('open_results', null);

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($task_id) and $task_id != 'all') {
            $query->where('id', $task_id);
        }

        if ($total_mark) {
            $query->where('total_mark', $total_mark);
        }

        if (!empty($user_id) and $user_id != 'all') {
            $query->where('user_id', $user_id);
        }

        if (!empty($instructor) and $instructor != 'all') {
            $query->where('creator_id', $instructor);
        }

        if ($status and $status != 'all') {
            $query->where('status', strtolower($status));
        }

        if (!empty($open_results)) {
            $query->where('status', 'waiting');
        }

        return $query;
    }

    public function showResult($taskResultId)
    {
        $user = auth()->user();

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->where(function ($query) use ($user, $tasksIds) {
                $query->where('user_id', $user->id)
                    ->orWhereIn('task_id', $tasksIds);
            })->with([
                'task' => function ($query) {
                    $query->with(['webinar']);
                }
            ])->first();

        if (!empty($taskResult)) {
            $numberOfAttempt = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->count();

            $student = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->first();


            $data = [
                'pageTitle' => trans('task.result'),
                'task' => $taskResult->task,
                'taskResult' => $taskResult,
                'userAnswers' => json_decode($taskResult->results, true),
                'numberOfAttempt' => $numberOfAttempt,
                'student' => $student,
            ];

            return view(getTemplate() . '.panel.tasks.task_result', $data);
        }

        abort(404);
    }

    public function destroyTaskResult($taskResultId)
    {
        $user = auth()->user();

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->whereIn('task_id', $tasksIds)
            ->first();

        if (!empty($taskResult)) {
            $taskResult->delete();

            return response()->json([
                'code' => 200
            ], 200);
        }

        return response()->json([], 422);
    }

    public function editResult($taskResultId)
    {
        $user = auth()->user();

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->whereIn('task_id', $tasksIds)
            ->first();

        if (!empty($taskResult)) {
            $numberOfAttempt = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->count();

            $student = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->first();

            $task = $taskResult->task;

            $data = [
                'pageTitle' => trans('task.result'),
                'teacherReviews' => true,
                'task' => $task,
                'taskResult' => $taskResult,
                'newTaskStart' => $taskResult,
                'userAnswers' => json_decode($taskResult->results, true),
                'numberOfAttempt' => $numberOfAttempt,
                'student' => $student
            ];

            return view(getTemplate() . '.panel.tasks.task_result', $data);
        }

        abort(404);
    }

    public function updateResult(Request $request, $id)
    {
        $user = auth()->user();
        $task = Task::where('id', $id)
            ->where('creator_id', $user->id)
            ->first();

        if (!empty($task)) {
            $taskResultId = $request->get('task_result_id');

            if (!empty($taskResultId)) {

                $taskResult = TasksResult::where('id', $taskResultId)
                    ->where('task_id', $task->id)
                    ->first();

                if (!empty($taskResult)) {
                    // Reglas de validación
                    $validationRules = [
                        'user_grade' => 'required|numeric|between:0,5', // El campo es obligatorio y debe ser numérico.
                    ];

                    // Mensajes de error personalizados
                    $customMessages = [
                        'user_grade.required' => 'El campo de calificación es obligatorio.',
                        'user_grade.numeric' => 'El campo de calificación debe ser un número.',
                    ];

                    // Validación de datos
                    $validatedData = $request->validate($validationRules, $customMessages);

                    $user_grade = $validatedData['user_grade'];

                    $taskResult->user_grade = $user_grade;
                    $passMark = $task->pass_mark;

                    if ($taskResult->user_grade >= $passMark) {
                        $taskResult->status = TasksResult::$passed;
                    } else {
                        $taskResult->status = TasksResult::$failed;
                    }

                    $taskResult->save();

                    $notifyOptions = [
                        '[c.title]' => $task->webinar ? $task->webinar->title : '-',
                        '[t.title]' => $task->title,
                        '[t.result]' => $taskResult->status,
                    ];
                    $notificationTemplate = NotificationTemplate::where('title', 'Waiting task result')->first();
                    sendNotificationTask($notificationTemplate->id, $notifyOptions, $taskResult->user_id);


                    return redirect('panel/tasks/results');
                }
            }
        }

        abort(404);
    }

    public function destroyTaskResultStudent($taskResultId)
    {
        $user = auth()->user();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->first();

        if (!empty($taskResult)) {
            if ($taskResult->user_id == $user->id){
                $taskResult->delete();

                return response()->json([
                    'code' => 200
                ], 200);
            }

        }

        return response()->json([], 422);
    }

    public function editResult_student($taskResultId)
    {
        $user = auth()->user();
        $task = TasksResult::find($taskResultId)->task;
        $webinar = $task->webinar;

        // Obtener el grupo asociado a la tarea del resultado
        $taskGroupId = $task->group_id;

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        // Verificar si el estudiante está asociado al mismo grupo que la tarea del resultado
        $isAssociated = GroupStudent::where('user_id', $user->id)
            ->where('group_id', $taskGroupId)
            ->exists();

        if (!$isAssociated) {
            // El estudiante no está asociado al mismo grupo que la tarea
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => trans('cart.not_available'),
                'status' => 'error'
            ];

            return back()->with(['toast' => $toastData]);
        }

        $checkUserHasBought = $webinar->checkUserHasBought($user);

        if (!$checkUserHasBought) {
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => trans('cart.you_not_purchased_this_course'),
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }
        if (!empty($task->expiry_days)) {
            $hasAccess = false;
            $sale = $webinar->getSaleItem($user);

            $currentTimestamp = time();
            $expiryTimestamp = $task->expiry_days;

            if (!empty($sale)) {
                if ($expiryTimestamp >= $currentTimestamp) {
                    $hasAccess = true;
                }
            }

            if (!$hasAccess) {
                $toastData = [
                    'title' => trans('public.request_failed'),
                    'msg' => trans('update.your_access_to_this_task_has_been_expired'),
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }

        $taskResult = TasksResult::where('id', $taskResultId)
            ->where(function ($query) use ($user, $tasksIds) {
                $query->where('user_id', $user->id)
                    ->orWhereIn('task_id', $tasksIds);
            })->with([
                'task' => function ($query) {
                    $query->with(['webinar']);
                }
            ])->first();

        if (!empty($taskResult)) {
            $attempt_count = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->count();

            $student = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->first();


            $data = [
                'pageTitle' => trans('task.result'),
                'task' => $taskResult->task,
                'taskResult' => $taskResult,
                'newTaskStart' => $taskResult,
                'userAnswers' => json_decode($taskResult->results, true),
                'attempt_count' => $attempt_count,
                'student' => $student,
            ];

            return view(getTemplate() . '.panel.tasks.task_result_student', $data);
        }

        abort(404);
    }

    public function updateResult_student(Request $request, $id)
    {
        $user = auth()->user();
        $task = Task::where('id', $id)->first();

        $taskResultId = $request->input('task_result_id');

        $task2 = TasksResult::find($taskResultId)->task;
        $webinar = $task2->webinar;

        if (!empty($task2->expiry_days)) {
            $hasAccess = false;
            $sale = $webinar->getSaleItem($user);

            $currentTimestamp = time();
            $expiryTimestamp = $task->expiry_days;

            if (!empty($sale)) {
                if ($expiryTimestamp >= $currentTimestamp) {
                    $hasAccess = true;
                }
            }

            if (!$hasAccess) {
                $toastData = [
                    'title' => trans('public.request_failed'),
                    'msg' => trans('update.your_access_to_this_task_has_been_expired'),
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }

        if (!empty($taskResultId)) {
            $taskResult = TasksResult::where('id', $taskResultId)
                ->where('user_id', $user->id)
                ->first();

            if (!empty($taskResult)){

                if (trim($taskResult->status) == "waiting") {

                    $this->validate($request, [
                        'answer' => 'required|min:2',
                    ]);

                    $data = $request->all();

                    $path = null;

                    if($taskResult->attach){
                        $path = $taskResult->attach;
                    }

                    if ($request->hasFile('uploaded_file')) {
                        $uploadedFile = $request->file('uploaded_file');

                        // Generar la ruta de almacenamiento
                        $path = '/store/' . $user->id . '/' . $uploadedFile->getClientOriginalName();

                        // Almacenar el archivo en el sistema de archivos
                        $uploadedFile->storeAs('/' . $user->id, $uploadedFile->getClientOriginalName(), 'public');
                    }

                    $taskResult->update([
                        'results' => $data['answer'],
                        'attach' => $path,
                        'created_at' => time(),
                    ]);

                    return redirect()->route('task_status', ['taskResultId' => $taskResult]);
                }else{
                    return redirect()->route('task_status', ['taskResultId' => $taskResult]);
                }
            }

        }

        abort(404);
    }

    public function orderItems(Request $request, $taskId)
    {
        $user = auth()->user();
        $data = $request->all();

        $validator = Validator::make($data, [
            'items' => 'required',
            'table' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $task = Task::query()->where('id', $taskId)
            ->where('creator_id', $user->id)
            ->first();

        if (!empty($task)) {
            $tableName = $data['table'];
            $itemIds = explode(',', $data['items']);

            if (!is_array($itemIds) and !empty($itemIds)) {
                $itemIds = [$itemIds];
            }

            if (!empty($itemIds) and is_array($itemIds) and count($itemIds)) {
                switch ($tableName) {
                   /* case 'tasks_questions':
                        foreach ($itemIds as $order => $id) {
                            TasksQuestion::where('id', $id)
                                ->where('task_id', $task->id)
                                ->update(['order' => ($order + 1)]);
                        }
                        break;
                   */
                }
            }
        }

        return response()->json([
            'title' => trans('public.request_success'),
            'msg' => trans('update.items_sorted_successful')
        ]);
    }

}
