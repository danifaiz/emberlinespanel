<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function project()
    {
        return $this->belongsToOne('App\Project');
    }
    protected $table = "projects_gallery";
    protected $fillable = ["image_name","image_type","grid","image_url","sequence"];
}
