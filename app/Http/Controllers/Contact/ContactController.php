<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(){
        return view('frontend.contact');
    }

    public function store(Request $request){
        $postData = $request->except('_token');

        $result = Contact::create($postData);
        if($result){
            return redirect('/')->with('success', 'We will get back to you soon.');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
