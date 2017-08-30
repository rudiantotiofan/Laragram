<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Image;

class GuestsController extends Controller
{
    public function index(Request $request){
        $images = Image::all();
        return view('welcome');
    }
}
