<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacherTest extends Model
{
    protected $fillable =['start','name', 'duration', 'dzialy_id', 'teacher_id', 'threshold', 'questionsAmount', 'groups_model_id'];
    public function students() {
        return $this -> belongsToMany(User::class, 'user_teacher_test');
    }
    public function teacher() {
        return $this -> belongsTo(User::class, 'teacher_id');
    }
    public function dzial() {
        return $this -> belongsTo(Dzialy::class, 'dzialy_id');
    }
    public function activeTests() {
        return $this -> hasMany(activeTests::class, 'teacher_test_id');
    }
    public function wyniki() {
        return $this-> hasMany(wyniki::class, 'teacher_test_id');
    }

    public function group() {
        return $this-> belongsTo(groupsModel::class, 'groups_model_id');
    }
}
