<?php

namespace App;

use App\klasy;
use App\wyniki;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\groupsModel;
use App\schoolsModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function klasa()
    {
        return $this->belongsTo('App\klasy', 'id_klasy');
    }

    public function wyniki()
    {
        return $this->hasMany('App\Wyniki', 'id_user');
    }

    public function teacherGroups()
    {
        return $this->hasMany('App\groupsModel', 'teacher_id');
    }

    public function teacherTests() {
        return $this -> hasMany(teacherTest::class, 'teacher_id');
    }

    public function schools()
    {
        return $this->belongsToMany(schoolsModel::class);
    }

    public function studentGroups() {
        return $this->belongsToMany(groupsModel::class);
    }

    public function posts() {
        return $this->hasMany(groupPost::class, 'author_id');
    }

    public function studentTests() {
        return $this -> belongsToMany(teacherTest::class, 'user_teacher_test');
    }

    public function comments(){
        return $this->hasMany(comments::class);
    }

}
