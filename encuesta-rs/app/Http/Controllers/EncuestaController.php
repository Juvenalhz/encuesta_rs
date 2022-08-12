<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\Participantes;
use Illuminate\Support\Facades\DB;

class EncuestaController extends Controller
{

    public function index()
    {
        $encuesta = Encuesta::all();
        return $encuesta;
    }

    public function store(Request $request)
    {
       
        $participante = new Participantes();

        $participante->nombre = $request->nombre;
        $participante->apellido = $request->apellido;
        $participante->edad = $request->edad;
        $participante->genero = $request->genero;
        $participante->correo = $request->correo;

        $participante->save();

        $encuesta = new Encuesta();

        $encuesta->id_participante = $participante->id;
        $encuesta->time_facebook = $request->time_facebook;
        $encuesta->time_whatsapp = $request->time_whatsapp;
        $encuesta->time_twitter = $request->time_twitter;
        $encuesta->time_instagram = $request->time_instagram;
        $encuesta->time_tiktok = $request->time_tiktok;
        $encuesta->rs_favorita = $request->rs_favorita;

        $encuesta->save();

    }

    public function avgRedesSociales()

    {
        $encuesta =  DB::table('encuesta')->select('AVG(time_facebook) as facebook')->get();
        return $encuesta;
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
