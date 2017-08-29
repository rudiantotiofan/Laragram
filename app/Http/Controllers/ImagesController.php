<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Image;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('user_id',Auth::user()->id)->get();
        return view('images.index')->with(compact('images'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'     =>  'required',
            'caption'   =>  'required',
            'user_id'   =>  'required|exists:users,id',
            'path'      =>  'required|image|max:2048'
        ]);       
        
        if ($validator->passes()) {
            $image = Image::create($request->except('path'));
            
            if($request->hasFile('path')){
                //mengambil file yang di upload
                $uploade_img = $request->file('path');
    
                //mengambil etension file
                $extension = $uploade_img->getClientOriginalExtension();
    
                //membuat nama file dengan random string
                $filename = md5(time()).'.'.$extension;
    
                //menyimpan images ke folder public/img/upload
                $destinationPath = public_path().DIRECTORY_SEPARATOR.'img/upload';
                $uploade_img->move($destinationPath, $filename);
                $image->path = $filename;
            }        
            $image->save(); 
            Session::flash("flash_notification",[
                "level"     =>  "success",
                "message"   =>  "New images has been added , '$request->title'"
            ]);
            //get updated image
            $images = Image::where('user_id',Auth::user()->id)->get();
            return view('images.gridContent', compact('images'));

        }
        return Response::json(['errors' => $validator->errors()]);        
        //return redirect(route('images.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
