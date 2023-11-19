<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;

class UserController extends Controller
{
    public function indexPage(){
        return view('frontend.index');
    }
    public function UserDestroy(Request $request): RedirectResponse
        {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }// end method

    public function userProfile(){
        $user = Auth()->user()->id;
        $userData = User::find($user);
        return view('frontend.displays.user_profile',compact('userData'));
    }

    public function userProfileStore(Request $req){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;

        if($req->file('photo')){
            $file = $req->file('photo');
            @unlink(public_path("uploads/user_images/").$data->photo);
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path("uploads/user_images/"),$filename);  
            $data['photo'] = $filename;
            $notification = array(
                'message'=>'Updated successfully',
                'alert-type'=>'success',
            );
            $data->save();
            return redirect()->back()->with($notification);
        }
    }
    //end method

    public function Login(){
        return view('frontend.displays.login');
    }

    ///post login method
    public function loginUser(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        dd($request->user());

        $request->session()->regenerate();

        $notification = array(
            'message' => 'Login Successfully',
            'alert-type' => 'success'
        );
        $url = '';
        if ($request->user()->role === 'admin') {
            $url = "/admin/dashboard";
        } else if ($request->user()->role === 'agency') {
            $url = "/agency/dashboard";
        } else if ($request->user()->role === 'user') {
            $url = "/dashboard";
        }else{
            $url = "/dashboard";
        }
        dd($request->user()->role); 

        return redirect()->intended($url)->with($notification);
    }
}
