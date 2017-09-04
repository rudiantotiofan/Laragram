<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','user_id','image_id','read'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function image(){
        return $this->belongsTo('App\Image');
    }
}