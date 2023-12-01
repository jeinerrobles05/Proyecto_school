{{--@php
    $checkSequenceContent = $textLesson->checkSequenceContent();
    $sequenceContentHasError = (!empty($checkSequenceContent) and (!empty($checkSequenceContent['all_passed_items_error']) or !empty($checkSequenceContent['access_after_day_error'])));
@endphp--}}

<div class="accordion-row {{--rounded-sm border  p-15--}} mt-15">
    <div class="d-flex align-items-center justify-content-between" role="tab" id="textLessons_{{ $textLesson->id }}">
        <div class="d-flex align-items-center" @if(!empty($textLesson->content))href="#collapseTextLessons{{ $textLesson->id }}" aria-controls="collapseTextLessons{{ $textLesson->id }}" data-parent="#{{ $accordionParent }}" role="button" data-toggle="collapse" aria-expanded="true"@endif>
            {{--<span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file-text" width="20" height="20" class="text-gray "></i>
            </span>--}}
            <span class="font-weight-bold  font-14 file-title">{{ $textLesson->title }}</span>
        </div>

        @if(!empty($textLesson->content))
            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseTextLessons{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-controls="collapseTextLessons{{ !empty($textLesson) ? $textLesson->id :'record' }}" data-parent="#{{ $accordionParent }}" role="button" data-toggle="collapse" aria-expanded="true"></i>
        @endif
    </div>

    <div id="collapseTextLessons{{ $textLesson->id }}" aria-labelledby="textLessons_{{ $textLesson->id }}" class=" collapse" role="tabpanel">
        <div class="panel-collapse">
            <div class="text-gray">
                {!! $textLesson->content !!}
            </div>

        </div>

    </div>
</div>
