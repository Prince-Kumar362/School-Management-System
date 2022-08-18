<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas=User::all();
        $datas=User::where('usertype','Admin')->get();
        return view('backend.user.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'email'=>'unique:users|required',
            'name'=>'required|min:5',
        ]);
        $data=new User();
        $code=rand(100,999999);
        $data->usertype='Admin';
        $data->code=$code;
        $data->role=$request->role;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($code);
        $data->save();

        $notification=array(
            'message'=>'User Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('user.view')->with($notification);
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
        $data=User::find($id);
        return view('backend.user.edit',compact('data'));
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

        $validateData=$request->validate([
            'email'=>'required',
            'name'=>'required|min:5',
        ]);
        $data= User::find($id);
        $data->role=$request->role;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->save();

        $notification=array(
            'message'=>'User Update Successfully!!',
            'alert-type'=>'info'
        );
        return redirect()->route('user.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        $notification=array(
            'message'=>'User Delete Successfully!!',
            'alert-type'=>'info'
        );
        return redirect()->route('user.view')->with($notification);
    }
}
