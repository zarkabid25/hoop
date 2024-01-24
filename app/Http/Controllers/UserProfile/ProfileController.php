<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = User::where('id', auth()->user()->id)->first();
        $companyDetails = CompanyDetail::all();

        return view('portal.profile.profile', compact('user', 'companyDetails'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
           'name' => 'required | string | min:3',
           'phone' => 'nullable | regex:/[0-9]{10}/',
        ]);

        try{
            $postData = $request->except(['_token', 'profile_img']);

            if($request->hasFile('profile_img')){
                $postData['image'] = storeImage($request, 'profile_img');
            }

            $result = User::where('id', $id)->update($postData);

            if($result == '1'){
                return redirect()->back()->with('success', 'Successfully updated');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong.');
            }

        } catch (\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function changePassword($id){
        return view('portal.profile.password-update', compact('id'));
    }

    public function updatePassword(Request $request, $id){
        $this->validate($request, [
            'old_password' => 'required | string | min:8',
            'password' => 'required | string | confirmed | min:8',
        ]);

        try{
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password doesn't match!");
            }

            $result = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            if($result == '1'){
                return redirect()->back()->with('success', 'Successfully changed.');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong.');
            }

        } catch (\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
