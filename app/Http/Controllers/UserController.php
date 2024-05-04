<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Lineitem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userProfile(){
        $user = Auth()->user();
        $lineItems = Lineitem::where('user_id', $user->id)->orderBy('id','DESC')->get();
        $countries = Country::all();
        return view('userProfile',compact('user','countries','lineItems'));
    }

    public function updateUserProfile(Request $request){
        $request->validate([
            'fname'=>'required|min:3|max:15|string',
            'lname'=>'required|min:3|max:15|string|different:first_name',
            'email'=>'required|email',
            'contact'=>'numeric|nullable',
            'gender'=>'required|in:Male,Female',
            'address'=>'nullable|string|max:150',
            'country'=>'required|exists:countries,id',
            'profile'=>'mimes:jpg,jpeg,gif,png',
        ]);
        $requestData = $request->except(['_token','_method','update']);
        $user = User::find(auth()->user()->id);
        $user->update($requestData);
        return redirect()->route('userProfile')->withSuccess('User Profile Updated Successfully');
    }

    public function userProfileImageUpdate(Request $request){
        $request->validate([
            'profile'=>'required|mimes:jpg,jpeg,png,gif',
        ]);
        $requestData = $request->except(['_token','update']);
        $imgName = 'profiles/'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imgName);
        $requestData['profile']=$imgName;
        $user = User::find(auth()->user()->id);
        $existingProflie =$user->profile;
        $user->update($requestData);
        $proflieExists = public_path("$existingProflie");
        if(file_exists($proflieExists)){
            unlink($existingProflie);
        }

        return redirect()->route('userProfile')->withSuccess('User Profile Image Updated Successfully');
    }
}
