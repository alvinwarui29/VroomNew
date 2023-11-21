<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
require __DIR__ . '/vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

class UserController extends Controller
{
    public function loginUser(LoginRequest $request)    {
        $apiKey = config('app.APIKEY');
        $username =config('app.APIUSER');
        $AT = new AfricasTalking($username, $apiKey);
        $sms = $AT->sms();
        $from = '36703';
        $email = $request->email;
        $password = $request->password;
        $phone = "+254743170028";
        $user = User::where('email', $email)->orWhere('phone', $phone)->first();
    
    
        if($user){
            $message = "You have successfully logged in to VROOM. Enjoy our wide variety of tours.";
            if(Hash::check($password,$user->password)){
                $notification = array(
                    'message'=>'Login successfully',
                    'alert-type'=>'success',
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
            $notification = array(
                'message'=>'Updated successfully',
                'alert-type'=>'success',
            );
    
            return redirect()->intended($url)->with($notification);
                
            }else{
                $notification = array(
                    'message'=>'Password not matched',
                    'alert-type'=>'error',
                );
                return redirect()->back()->with($notification);
            }
    
        }else{
            $notification = array(
                'message'=>'User not registered',
                'alert-type'=>'error',
            );
            return redirect()->back()->with($notification);
        }
    
    }
    ///post login method
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

}
