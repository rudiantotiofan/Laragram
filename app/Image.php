<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title','user_id','path','caption'];

    public function user(){
        $this->belongsTo('App\User');
    }
}
