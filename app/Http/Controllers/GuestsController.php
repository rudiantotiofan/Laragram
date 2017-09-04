<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Image;
use App\User;
use App\Role;

class GuestsController extends Controller
{
    public function index(Request $request){
        $albums = User::with('images')
            ->join('role_user','id','=','role_user.user_id')
            ->where('role_user.role_id',2)->get();
        
        $images = Image::all();
        return view('welcome')->with(compact('albums'));
    }
    
    public function show($id){
        $images = Image::where('user_id',$id)->get();
        return view('show')->with(compact('images'));
    }
}
