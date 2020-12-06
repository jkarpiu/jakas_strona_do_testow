<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacherTest extends Model
{
    protected $fillable =['start', 'end', 'dzialy_id', 'teacher_id'];
    public function students() {
        return $this -> belongsToMany(User::class);
    }
    public function teacher() {
        return $this -> belongsTo(User::class, 'teacher_id');
    }
}
