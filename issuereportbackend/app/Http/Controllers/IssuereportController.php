<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issuereportform;
use Carbon\Carbon;

class IssuereportController extends Controller
{
public function store_issuereportform(Request $request)
{
try {
    $issuereport = new Issuereportform;
    $issuereport->issuetitle=$request->issuetitle;
    $issuereport->description=$request->description;
    //$issuereport->priority=$request->priority;
    $issuereport->reportedname=$request->reportedname;
    $issuereport->email=$request->email;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $issuereport->image_path = $imagePath;
    }
    
    $issuereport->created_at=Carbon::now();
    $issuereport->updated_at=Carbon::now();
    $issuereport->save();

    return response()->json([

       'message'=>'issue reported succesfully',
       'issuereport'=>$issuereport,
       'status'=>200,

    ]);

    }
    catch(\Exception $e)
     {

    return response()->json([

        'message'=>'issue reported unsuccesfully',
        'issuereport'=>$issuereport,
        'status'=>404,
        '4'=>$e,
 
    ]);
     }
    }
    public function show()
    {
        $issuerecords = Issuerecord::all();
        return response()->json(['issuerecords' => $issuerecords], 200);
    }
}
