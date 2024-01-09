<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $postData = $request->except('_token');

        try{
            $postData['user_id'] = auth()->user()->id;
            $result = Comment::create($postData);
            if($result){
                return redirect()->route('order.show', ['order' => $request->order_id])->with('success', 'Successfully posted');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
