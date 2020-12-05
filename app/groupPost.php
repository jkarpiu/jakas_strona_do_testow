<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groupPost extends Model
{
    protected $fillable = ['author_id', 'groups_model_id', 'content'];

    public function group () {
        return $this -> belongsTo(groupsModel::class );
    }
}
