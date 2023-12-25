<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Issuereportform;

class IssuesolveController extends Controller
{
    public function issue_solve ()
{
    //return Issuereportform:: all();
    $issuereportforms= Issuereportform::all();
    return response ()->json(['issuereportforms'=> $issuereportforms], 200);
}
}
