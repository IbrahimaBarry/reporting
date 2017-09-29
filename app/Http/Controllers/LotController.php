<?php

namespace App\Http\Controllers;

use App\Lot;
use Illuminate\Http\Request;

class LotController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->request as $req) {
            $lot = Lot::findOrFail($req['id']);
            $lot->nbrDoc = $req['nbrDoc'];
            $lot->nbrPage = $req['nbrPage'];
            $lot->user_id = $req['user_id'];
            $lot->save();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {
        $lot = Lot::findOrFail($request->lot_id);
        $lot->time += $request->time;
        $lot->observation = $request->observation;
        $lot->completed = true;
        $lot->save();

        return redirect()->back()->with('success', 'Traitement du lot terminé');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function uncomplete(Request $request, Lot $lot)
    {
        if ($lot->projet->completed)
            return redirect()->back()->with('warning', 'Le projet a déja été fermé. Veillez ré-ouvrir le projet pour annulé le traitement du lot');
        $lot->completed = false;
        $lot->save();

        return redirect()->back()->with('success', 'Traitement du lot annulé');
    }

     /**
     * Save time of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $lot = Lot::findOrFail($request->lot_id);
        $lot->time += $request->time;
        $lot->save();

        return redirect()->back()->with('success', 'Traitement du lot reporté');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lot $lot)
    {
        //
    }
}
