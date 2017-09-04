<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Image;
use App\User;

class GuestsController extends Controller
{
    public function index(Request $request){
        //$album = Users::where
        $images = Image::all();
        return view('welcome')->with(compact('images'));
    }
}
