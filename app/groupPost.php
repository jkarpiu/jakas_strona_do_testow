<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groupPost extends Model
{
    protected $fillable = ['author_id', 'groups_model_id', 'content', 'title', 'active'];

    public function comments(){
        return $this->hasMany(comments::class);
    }
    public function group () {
        return $this -> belongsTo(groupsModel::class );
    }

    public function author() {
        return $this -> belongsTo (User::class, 'author_id');
    }

}
