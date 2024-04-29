<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        $countries = Country::all();
        return view('register', compact('countries'));
    }

    public function login(){
        return view('login');
    }

    public function storeUser(Request $request){
        $request->validate([
            'fname'=>'required|min:3|max:15|string',
            'lname'=>'required|min:3|max:15|string|different:first_name',
            'email'=>'required|email|unique:users,email',
            'contact'=>'numeric|nullable',
            'password'=>'required|min:5',
            'gender'=>'required|in:Male,Female',
            'address'=>'nullable|string|max:150',
            'country'=>'required|exists:countries,id',
            'profile'=>'mimes:jpg,jpeg,gif,png',
        ]);

        $requestData = $request->except(['_token', ' regist']);
        $imgName = 'profiles/'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imgName);
        $requestData['profile']=$imgName;
        $requestData['role_id']=User::USER_ROLE;
        $user = User::create($requestData);
        return redirect()->route('home',[],301)->withSuccess('User Created Successfully!');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $data = $request->only('email','password');
        if(Auth::attempt($data)){
            if(auth()->user()->role_id == User::ADMIN_ROLE){
                return redirect()->route('adminIndex',[],301);
            }else{
                return redirect()->route('home',[],301)->withSuccess('User Logged In Successfully!');
            }
        }else{
            return redirect()->route('login',[],301)->withErrors(['Invalid Email or Password']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
  	    return redirect()->route('login',[],301)->withSuccess('User Logged Out Successfully!');
    }
}
