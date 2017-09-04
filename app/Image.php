<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title','user_id','path','caption'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function Comments(){
        return $this->hasMany('App\Comment');
    }
}
