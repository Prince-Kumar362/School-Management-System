<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Models\FeeCaterory;
use App\Models\StudentClass;

class FeeCategoryAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas=StudentClass::all();
        $datas=FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.Setup.Fee_category_amount.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=StudentClass::all();
        $fee_categorys=FeeCaterory::all();
        return view('backend.Setup.Fee_category_amount.add',compact('classes','fee_categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countClass=count($request->class_id);
        if($countClass !=NULL){
            for($i=0;$i<$countClass;$i++){
                $fee_amount=new FeeCategoryAmount();
                $fee_amount->fee_category_id=$request->fee_category_id;
                $fee_amount->class_id=$request->class_id[$i];
                $fee_amount->amount=$request->amount[$i];
                $fee_amount->save();
            }
        }
        $notification=array(
            'message'=>'Fee Category Amount Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.amount.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas=FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
       return view('backend.Setup.Fee_category_amount.show',compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
        $fee_categorys=FeeCaterory::all();
        $classes=StudentClass::all();
       return view('backend.Setup.Fee_category_amount.edit',compact('data','fee_categorys','classes'));
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
        if($request->class_id==Null){
            $notification=array(
                'message'=>'Sorry You do Select ant class amount!!',
                'alert-type'=>'error'
            );
            return redirect()->route('fee.amount.edit',$id)->with($notification);
        }else{
            FeeCategoryAmount::where('fee_category_id',$id)->delete();
            $countClass=count($request->class_id);
            for($i=0;$i<$countClass;$i++){
                $fee_amount=new FeeCategoryAmount();
                $fee_amount->fee_category_id=$id;
                $fee_amount->class_id=$request->class_id[$i];
                $fee_amount->amount=$request->amount[$i];
                $fee_amount->save();
            }
            $notification=array(
                'message'=>'Fee Category Amount Update Successfully!!',
                'alert-type'=>'success'
            );
            return redirect()->route('fee.amount.view')->with($notification);
        }
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
