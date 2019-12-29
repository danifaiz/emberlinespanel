<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
}
