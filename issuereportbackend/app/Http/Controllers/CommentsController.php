<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Carbon\Carbon;

class CommentsController extends Controller
{
    
        public function store_comments(Request $request)
        {
        try {
            $comments = new Comment;
            $comments->comment=$request->comment;
            $comments->created_at=Carbon::now();
            $comments->updated_at=Carbon::now();
            $comments->save();
        
            return response()->json([
        
               'message'=>'comment succesfully',
               'comment'=>$comment,
               'status'=>200,
        
            ]);
        
            }
            catch(\Exception $e)
             {
        
            return response()->json([
        
                'message'=>'comment unsuccesfully',
                'comment'=>$comments,
                'status'=>404,
                '4'=>$e,
         
            ]);
             }
            }
        
           public function show_comments()
{
    try {
        $comment = Comment::all();
        return response()->json(['Comment' => $comment], 200);
    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error in show_comments: ' . $e->getMessage());

        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

}
