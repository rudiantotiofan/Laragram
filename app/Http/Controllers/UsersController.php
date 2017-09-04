<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Response;
use App\User;
use App\Role;
class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$users = User::where('name','like','%'.$request->keyword.'%')->where('id','<>',Auth::user()->id);
        $users = User::with('roles')->whereNotIn('id',[Auth::user()->id])->where('name','like','%'.$request->keyword.'%')->get();
        if($request->ajax()){
            return view('users.tables',compact('users'));
        }else{
            return view('users.index',compact('users'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        if($validator->passes()){
            $userStore = User::create($request->except('repassword'));
            $memberRole = Role::where('name','admin')->first();
            $userStore->password = bcrypt($request->password);
            $userStore->attachRole($memberRole);
            $userStore->save();

            Session::flash("flash_notification",[
                "level"     =>  "success",
                "message"   =>  "Admin account with name $request->name has been created successfully."
            ]);

            $users = User::with('roles')->whereNotIn('id',[Auth::user()->id])->get();
            return view('users.tables',compact('users'));
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return Response::json($users);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ($request->password != "" ? 'string|min:6|confirmed' : '')
        ]);
        if($validator->passes()){
            $userUpdate = User::find($id);
            if($request->password != ""){
                $userUpdate->update($request->all());
                $userUpdate->password = bcrypt($request->password);
            }else{
                $userUpdate->update($request->except('password')) ;
            }                
            $userUpdate->save();

            Session::flash("flash_notification",[
                "level"     =>  "success",
                "message"   =>  "Admin account with name $request->name has been updated successfully."
            ]);

            $users = User::with('roles')->whereNotIn('id',[Auth::user()->id])->get();
            return view('users.tables',compact('users'));
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $useDestroy = User::destroy($id);
        $users = User::with('roles')->whereNotIn('id',[Auth::user()->id])->get();
        return view('users.tables',compact('users'));
    }
}
