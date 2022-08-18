<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image; 

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=Slider::all();
        return view('admin.slider.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'=>'mimes:jpg,.jpeg,png',
        ]);

        $image_name=$request->file('image');

        $name_gen=hexdec(uniqid()).'.'.$image_name->getClientOriginalExtension();
        $path = public_path('image/slider/'.$name_gen);
        Image::make($image_name->getRealPath())->resize(1920,1088)->save($path);

        $last_img='image/slider/'.$name_gen;
    
        $image= new Slider;
        $image->image=$last_img;
        $image->title=$request->title;
        $image->description=$request->description;
        $image->save();
        $notification=array(
            'message'=>'Slider Inserted Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.slider'))->with($notification);
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
        $image=Slider::find($id);
        return view('admin.slider.edit',compact('image'));
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
        $old_image=$request->old_image;
        $image_name=$request->file('image');
        if($image_name){
            $name_gen=hexdec(uniqid()).'.'.$image_name->getClientOriginalExtension();
            $path = public_path('image/slider/'.$name_gen);
            Image::make($image_name->getRealPath())->resize(1920,1088)->save($path);
    
            $last_img='image/slider/'.$name_gen;
       
        $unlink=unlink($old_image);

        $image=Slider::find($id);
        $image->title=$request->title;
        $image->description=$request->description;
        $image->image=$last_img;
        $image->update();
        $notification=array(
            'message'=>'Slider Update Successfully!!',
            'alert-type'=>'success'
        );
            return Redirect(route('home.slider'))->with($notification);
    }else{
       
        $image=Slider::find($id);
        $image->title=$request->title;
        $image->description=$request->description;
        $image->update();
        $notification=array(
            'message'=>'Slider Update Successfully!!',
            'alert-type'=>'success'
        );
            return Redirect(route('home.slider'))->with($notification);
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
        $image=Slider::find($id);
        $old_image=$image->image;
        unlink($old_image);
        Slider::find($id)->delete();
        $notification=array(
            'message'=>'Slider Delete Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.slider'))->with($notification);
    }
}