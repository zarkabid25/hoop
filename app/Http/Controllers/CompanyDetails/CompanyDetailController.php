<?php

namespace App\Http\Controllers\CompanyDetails;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyDetailController extends Controller
{
    public function index(){
        $companyDetails = CompanyDetail::all();
        return view('portal.admin.company-details.index', compact('companyDetails'));
    }

    public function create(){
        return view('portal.admin.company-details.add-detail');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "field_title"    => "required|array",
            "field_title.*"  => "required",
            "field_value"    => "field_value|array",
            "field_value.*"  => "required",
        ]);

        $postData = $request->except('_token');
        foreach ($postData['field_title'] as $key=>$val){
            $result = CompanyDetail::create([
                'field_title' => $val,
                'field_value' => $postData['field_value'][$key]
            ]);
        }

        if($result){
            return redirect()->back()->with('success', 'Successfully created.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

    public function edit($id){
        dd($id);
    }
}
