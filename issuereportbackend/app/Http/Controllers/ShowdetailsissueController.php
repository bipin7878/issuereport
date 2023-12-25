<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issuereportform;

class ShowdetailsissueController extends Controller
{
   

    public function show($id)
    {
        $Issuereportform = Issuereportform::find($id);

        if (!$Issuereportform) {
            return response()->json(['error' => 'Issue not found'], 404);
        }

        return response()->json(['issuereportform' => $Issuereportform]);
    }

}

