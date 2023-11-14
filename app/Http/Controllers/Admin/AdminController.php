<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AdminController extends Controller
{
    ///return dasboard
    public function dashboard(){
        return view('admin.index');
    }
    //end method

    //profile setup
    public function profileSetup(){
        return view('admin.profile.setup');
    }
    //end method

    //profile store
    public function adminProfileStore(Request $req){
        $id = Auth::user()->id;
        $admin = User::find($id);
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->phone = $req->phone;

        if($req->file('photo')){
            $file = $req->file('photo');
            @unlink(public_path('uploads/admin_images/'.$admin->photo));
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $admin['photo'] = $filename;
        }
        $notification = array(
            'message'=>'Updated successfully',
            'alert-type'=>'success',
        );
        $admin->save();
        return redirect()->back()->with($notification);
    }
    //end method
}
