<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lot;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['lots' => Auth::user()->lots()->where('completed', false)->paginate()]);
    }

    /**
     * Search the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('home', ['lots' => Auth::user()->lots()->with('projet')
            ->whereHas('projet', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->name.'%');
            })->latest()->paginate()]);
    }

     public function historique()
    {
        return view('historique', ['lots' => Auth::user()->lots()->where('completed', true)->paginate()]);
    }    
}
