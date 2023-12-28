<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newtest;
use Carbon\Carbon;

class NewtestController extends Controller
{
    public function newtest(Request $request)
{
    try {
        $newtest = new newtest;
        $newtest->name=$request->Name;
        $newtest->departname=$request->DepartName;
        $newtest->created_at=Carbon::now();
        $newtest->updated_at=Carbon::now();
        $newtest->save();
    
        return response()->json([
    
           'message'=>'succesfully',
           'newtest'=>$newtest,
           'status'=>200,
    
        ]);
    
        }
        catch(\Exception $e)
         {
    
        return response()->json([
    
            'message'=>'issue reported unsuccesfully',
            'newtest'=>$newtest,
            'status'=>404,
            '4'=>$e,
     
        ]);
         }
        }
        public function display()
        {
            $newtest = newtest::all();
            return response()->json(['newtest' => $newtest], 200);
        }
}
