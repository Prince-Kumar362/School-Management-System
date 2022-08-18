<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCaterory;

class FeeCateroryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=FeeCaterory::all();
        return view('backend.Setup.Fee_category.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.Fee_category.add');
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
            'name'=>'required|min:1|unique:fee_caterories,name',
        ]);
        $student=new FeeCaterory();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'Fee Category Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
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
        $data=FeeCaterory::find($id);
        return view('backend.Setup.Fee_category.edit',compact('data'));
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
            'name'=>'required|min:1|unique:fee_caterories,name',
        ]);
        $class=FeeCaterory::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'Fee Category Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=FeeCaterory::find($id);
        $class->delete();
        $notification=array(
            'message'=>'Fee Category Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }
}
