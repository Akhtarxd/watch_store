<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brands::all();
        return view('admin.brandList',['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addBrands');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:15|string',
            'description' => 'nullable|string|max:150',
            'image' => 'mimes:jpg,jpeg,gif,png',
        ]);
    
        $requestData = $request->except(['_token', 'add']);
    
        // Check if a file is uploaded before attempting to move it
        if ($request->hasFile('image')) {
            $imgName = 'brands/' . rand() . '.' . $request->image->extension();
            $request->image->move(public_path('brands/'), $imgName);
            $requestData['image'] = $imgName;
        }
    
        $brand=Brands::create($requestData);
    
        if (!empty($brand)) {
            return redirect()->route('brands.index', [], 301)->withSuccess('Brand Created Successfully!');
        } else {
            return redirect()->route('brands.index')->withError('Something Went Wrong Please Try Again');
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view('admin.brandEdit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brands $brand)
    {
        $request->validate([
            'name' => 'required|min:2|string',
            'description' => 'required|min:5|string',
        ]);

        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();
        return redirect()->route('brands.index')->with('success','Brand has been update successfully');
    }


    public function changeBrandStatus(Request $request, $id, $status = 1){
        $brand = Brands::find($id);
        if(!empty($brand)){
            $brand->is_active = $status;
            $brand->save();
            return redirect()->route('brands.index')->withSuccess('Brand Status Updated Successfully');
        }else{
            return redirect()->route('brands.index')->withError('Something Went Wrong Please Try Agian');
        }
    }

    public function changeBrandImage(Request $request,$id){
        $request->validate([
            'image'=>'required|mimes:jpg,jpeg,png,gif',
        ]);
        $requestData = $request->except(['_token','update']);
        $brand = Brands::find($id);
        if(!empty($brand)){
            $imgName = 'brands/'.rand().'.'.$request->image->extension();
            $request->image->move(public_path('brands/'),$imgName);
            $requestData['image']=$imgName;
            $existingProflie =$brand->image;
            $brand->update($requestData);
            $proflieExists = public_path("$existingProflie");
            if(file_exists($proflieExists)){
                unlink($existingProflie);
            }
    
            return redirect()->route('brands.index')->withSuccess('User Profile Image Updated Successfully');
        }else{
            return redirect()->route('brands.index')->withError('Something Went Wrong Please Try Agian');
        }
    }
}
