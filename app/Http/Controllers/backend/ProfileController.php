<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id=Auth::user()->id;
        $data=User::find($id);
        return view('backend.user.profile',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id=Auth::user()->id;
        $data=User::find($id);
        return view('backend.user.profile_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=User::find(Auth::user()->id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->gender=$request->gender;

        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('upload/user_image'.$data->image));
            $file_name=date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/user_image'),$file_name);
            $data['image']=$file_name;
        }
        $data->save();
        $notification=array(
            'message'=>'Profile Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('user.profile')->with($notification);
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
    public function Change_Password()
    {
        return view('backend.user.password');
    }
    public function Update_Password(Request $request)
    {
        $validateData=$request->validate([
            'current_password'=>'required',
            'password'=>'required|min:8|confirmed',
        ]);
        $hasedPassword=Auth::user()->password;
        if(Hash::check($request->current_password,$hasedPassword)){
            $user=User::find(Auth::id());
            $user->password=bcrypt($request->password);
            $user->save();
            // Auth::logout();
            return redirect('/');
        }else{
            return redirect()->back();
        }
    }
}
