<?php

namespace App\Http\Controllers;

use App\Projet;
use App\User;
use Illuminate\Http\Request;
use Auth;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projet', ['projets' => Projet::latest()->paginate()]);
    }

    /**
     * Search the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('projet', ['projets' => Projet::where('name', 'LIKE', '%'.$request->name.'%')->latest()->paginate()]);
    }

    /**
     * complete the resource.
     *
     * @param  \App\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function completed(Projet $projet)
    {
        foreach ($projet->lots as $lot) {
            if (!$lot->completed)
                return redirect()->back()->with('warning', 'Impossible de fermer le projet, tous les lots ne sont pas traités');
        }

        $projet->completed = !$projet->completed;
        $projet->save();

        return redirect()->back()->with('success', 'Status du projet modifié');
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tabs = [];
        for ($i=0; $i < $request->nbrLot; $i++) { 
            $tabs[] = ['num' => $i+1];
        }

        $projet = Projet::create($request->all());
        $projet->lots()->createMany($tabs);

        return redirect()->route('projets.show', $projet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
        return view('projetProfile', ['projet' => $projet, 'users' => User::where('name', '!=', 'BARRY Ibrahima')->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {
        foreach (Auth::user()->projets as $val) {
            if ($val == $projet) {
                $projet->delete();
                return redirect()->back()->with('success', 'Le projet à été supprimé');
            }
        }

        return redirect()->back()->with('error', 'Ce projet ne peut être supprimé que par ' . $projet->user->name);
    }
}
