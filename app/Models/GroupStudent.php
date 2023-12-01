<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{

    public $timestamps = false;
    protected $table = 'group_students';
    protected $guarded = ['id'];

    public function group()
    {
        return $this->belongsTo('App\course_group', 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
