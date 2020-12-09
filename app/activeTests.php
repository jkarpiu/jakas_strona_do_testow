<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activeTests extends Model
{
    protected $fillable = ['token', 'deadline', 'dzial_id', 'teacher_test_id'];

    public function wynik()
    {
        return $this->belongsTo(wyniki::class, 'active_test_id');
    }

    public function dzial()
    {
        return $this->belongsTo(Dzialy::class, 'dzial_id');
    }
    public function teacher_test()
    {
        return $this->belongsTo(teacherTest::class, 'teacher_test_id');
    }
}
