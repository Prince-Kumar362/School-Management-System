<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultipleImage;
use Image;

class multipleimageController extends Controller
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
        $datas=MultipleImage::all();
        return view('admin.multipleimage.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.multipleimage.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'image'=>'required|mimes:jpg,jpeg,png',
        // ]);
        $image_name=$request->file('image');
        foreach($image_name as $mul_img){
            $name_gen=hexdec(uniqid()).'.'.$mul_img->getClientOriginalExtension();
            $path = public_path('image/MultiImage/'.$name_gen);
            Image::make($mul_img->getRealPath())->resize(1920,1088)->save($path);

            $last_img='image/MultiImage/'.$name_gen;
        
            $image= new MultipleImage;
            $image->image=$last_img;
            $image->save();
        }
        $notification=array(
            'message'=>'Portfolio Save Successfully!!',
            'alert-type'=>'success'
        );
            return Redirect(route('home.multipleImage'))->with($notification);
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
        $image=MultipleImage::find($id);
        return view('admin.multipleimage.edit',compact('image'));
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
        $validated = $request->validate([
           
            'image'=>'required|mimes:jpg,jpeg,png',
        ]);
        $old_image=$request->old_image;
        $image_name=$request->file('image');
      
            $name_gen=hexdec(uniqid()).'.'.$image_name->getClientOriginalExtension();
            $path = public_path('image/MultiImage/'.$name_gen);
            Image::make($image_name->getRealPath())->resize(1920,1088)->save($path);
    
            $last_img='image/MultiImage/'.$name_gen;
       
        $unlink=@unlink($old_image);

        $image=MultipleImage::find($id);
        $image->image=$last_img;
        $image->update();
        $notification=array(
            'message'=>'Portfolio Update Successfully!!',
            'alert-type'=>'success'
        );
            return Redirect(route('home.multipleImage'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=MultipleImage::find($id);
        $old_image=$image->image;
        unlink($old_image);
        MultipleImage::find($id)->delete();
        $notification=array(
            'message'=>'Portfolio Delete Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.multipleImage'))->with($notification);
    }
}
