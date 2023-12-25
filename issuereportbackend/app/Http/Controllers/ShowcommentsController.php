<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class ShowcommentsController extends Controller
{
    public function show_comment ()
    {
        //return Issuereportform:: all();
        $comment= Comment::all();
        return response ()->json(['Comment'=> $comment], 200);
    }
}
