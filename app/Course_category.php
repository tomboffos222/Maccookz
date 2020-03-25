<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course_video;
class Course_category extends Model
{
    //
    public function videos(){
        return $this->hasMany('App\Course_video','category_id','id');
    }
}
