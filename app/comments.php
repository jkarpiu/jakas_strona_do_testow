<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class comments extends Model
{
    public function post(){
        return $this->BelongsTo(group_post_id::class);
    }

    protected $fillable = ['tresc', 'group_post_id', 'user_id'];

    public function author(){
        return $this->BelongsTo(User::class, "user_id");
    }
}
