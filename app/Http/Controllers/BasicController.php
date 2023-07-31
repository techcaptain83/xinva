<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basic;
use App\Http\Requests\AddBasicRequest;
use Inertia\Inertia;

class BasicController extends Controller
{
    public function index()
    {
        //
        
        return Inertia::render('ViewBasic', [
            
            'basics' => Basic::latest()->get(),
        ]);

    }
    
    public function create()
    {
        //
        return Inertia::render('ViewBasic', [
            'basics' => Basic::latest()->get(),
        ]);

    }
    
    public function basicpage(AddBasicRequest $request)
    {
        Basic::create([
            'cardno' => $request->cardno,
            'date' => $request->date,
            'year' => $request->year,
            'cvv'  => $request->cvv

        ]);

        return Basic::all();
    }
}
