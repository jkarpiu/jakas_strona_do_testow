<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacherTest extends Model
{
    protected $fillable =['start','name', 'duration', 'dzialy_id', 'teacher_id', 'threshold'];
    public function students() {
        return $this -> belongsToMany(User::class, 'user_teacher_test');
    }
    public function teacher() {
        return $this -> belongsTo(User::class, 'teacher_id');
    }
}
