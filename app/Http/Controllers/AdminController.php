<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function  index() {
        return view('admin.index');
    }

    public function userList(){
        $users = User::all();
        return view('admin.userlist',['users' => $users]);
    }

    public function editUser(Request $request, $id){
        $user = User::find($id);
        if(empty($user)){
            return back()->with('error', 'User not found');
        }
        $countries = Country::all();
        return view('admin.userEdit',['user'=>$user,'countries' => $countries]);
    }

    public function updateUser(Request $request, $id){
        $request->validate([
            'fname'=>'required|min:3|max:15|string',
            'lname'=>'required|min:3|max:15|string|different:first_name',
            'email'=>'required|email',
            'contact'=>'numeric|nullable',
            'gender'=>'required|in:Male,Female',
            'role_id'=>'required|in:0,1',
            'address'=>'nullable|string|max:150',
            'country'=>'required|exists:countries,id',
            'profile'=>'mimes:jpg,jpeg,gif,png',
        ]);
        $requestData = $request->except(['_token','_method','update']);
        $user = User::find($id);
        if(!empty($user)){
            $user->update($requestData);
            return redirect()->route('userList')->withSuccess('User Data Updated Successfully');
        }else{
            return redirect()->route('userList')->withError('Something Went Wrong Please Try Agian');
        }
    }

    public function updateUserProfile(Request $request, $id){
        $request->validate([
            'profile'=>'required|mimes:jpg,jpeg,png,gif',
        ]);
        $requestData = $request->except(['_token','update']);
        $imgName = 'profiles/'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imgName);
        $requestData['profile']=$imgName;
        $user = User::find($id);
        if(!empty($user)){
            $existingProflie =$user->profile;
            $user->update($requestData);
            $proflieExists = public_path("$existingProflie");
            if(file_exists($proflieExists)){
                unlink($existingProflie);
            }
    
            return redirect()->route('userList')->withSuccess('User Profile Image Updated Successfully');
        }else{
            return redirect()->route('userList')->withError('Something Went Wrong Please Try Agian');
        }
    }

    public function registerUserProfile(){
        $countries = Country::all();
        return view('admin.userRegister',['countries' => $countries]);
    }

    public function registerUserProfileData(Request $request) {
        $request->validate([
            'fname' => 'required|min:3|max:15|string',
            'lname' => 'required|min:3|max:15|string|different:first_name',
            'email' => 'required|email|unique:users,email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:5',
            'gender' => 'required|in:Male,Female',
            'role_id' => 'required|in:0,1',
            'address' => 'nullable|string|max:150',
            'country' => 'required|exists:countries,id',
            'profile' => 'mimes:jpg,jpeg,gif,png',
        ]);
    
        $requestData = $request->except(['_token', 'regist']);
    
        // Check if a file is uploaded before attempting to move it
        if ($request->hasFile('profile')) {
            $imgName = 'profiles/' . rand() . '.' . $request->profile->extension();
            $request->profile->move(public_path('profiles/'), $imgName);
            $requestData['profile'] = $imgName;
        }
    
        $user = User::create($requestData);
    
        if (!empty($user)) {
            return redirect()->route('userList', [], 301)->withSuccess('User Created Successfully!');
        } else {
            return redirect()->route('userList')->withError('Something Went Wrong Please Try Again');
        }
    }
    
    public function changeUserStatus(Request $request, $id, $status=1){
        $user = User::find($id);
        if(!empty($user)){
            $user->is_active = $status;
            $user->save();
            return redirect()->route('userList')->withSuccess('User Profile Image Updated Successfully');
        }else{
            return redirect()->route('userList')->withError('Something Went Wrong Please Try Agian');
        }
    }
}
