<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupInvitation extends Model
{
    protected $fillable = ['code', 'groups_model_id', 'expire_date'];
    public function group(){
        return $this->belongsTo(groupsModel::class);
    }
}
