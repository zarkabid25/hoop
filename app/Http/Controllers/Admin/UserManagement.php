<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('portal.admin.user-management.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('portal.admin.user-management.create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | string | max:30',
            'password' => 'required | string | min:8',
            'email' => 'required | string | unique:users',
            'role' => 'required | string',
        ]);

        $postData = $request->except('_token');

        try{
            $mailData = [
                'userName' => $postData['name'],
                'password' => $postData['password'],
            ];

            $postData['password'] = bcrypt($postData['password']);
            $user = User::create($postData);

            Mail::to($user->email)->send(new SendPasswordEmail($mailData));

            if($user){
                return redirect()->route('user_management.index')->with('success', 'Successfully created.');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('portal.admin.user-management.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'name' => 'required | string | max:30',
           'email' => 'required | string | unique:users',
           'role' => 'required | string',
        ]);

        $postData = $request->except(['_token', '_method', 'password']);

        try{
            if(!empty($postData['password'])){
                $postData['password'] = bcrypt($postData['password']);
            }

            $user = User::where('id', $id)->update($postData);

            if($user == 1){
                return redirect()->route('user_management.index')->with('success', 'Successfully updated.');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        if($user == 1){
            return redirect()->route('user_management.index')->with('success', 'Successfully deleted.');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
