<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use Carbon\Carbon;

class SettingsController extends Controller
{
    public function index()
    {
    	return view('admin.settings');
    }

    public function profileUpdate(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required|email',
    		'image' => 'image'
    	]);

    	//get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        $user = User::findOrFail(Auth::id());

        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check if directory exists

            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }

            //delete old profile image
	        if(Storage::disk('public')->exists('profile/'.$user->image))
	        {
	            Storage::disk('public')->delete('profile/'.$user->image);
	        }

            //resize image for profile and upload

            $profile = Image::make($image)->resize(500,500)->save($imageName);
            Storage::disk('public')->put('profile/'.$imageName,$profile);


        }else
        {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Profile Updated', 'Success');

        return redirect()->back();
    }

    public function passwordUpdate(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required',
    		'password' => 'required|confirmed',
    	]);

    	$hashedPassword = Auth::user()->password;

    	if(Hash::check($request->old_password,$hashedPassword))
    	{
    		if(!Hash::check($request->password,$hashedPassword))
	    	{
	    		$user = User::find(Auth::id());
	    		$user->password = Hash::make($request->password);
	    		$user->save();

	    		Toastr::success('Password Updated', 'Success');
	    		
	    		Auth::logout();

        		return redirect()->back();
	    	}else{
	    		Toastr::error('New Password can not be same as old password', 'Error');

        		return redirect()->back();
	    	}
    	}else{
    		Toastr::error('Current password wrong', 'Error');

            return redirect()->back();
    	}
    }
}
