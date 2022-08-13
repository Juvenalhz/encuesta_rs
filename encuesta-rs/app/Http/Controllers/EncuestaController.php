<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\Participantes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RedesSocialesController;
use App\Models\RedesSociales;

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
         $encuesta = Encuesta::select(DB::raw("avg(time_facebook) as facebook, avg(time_instagram) as instgram, avg(time_whatsapp) as whatsapp, avg(time_twitter) as twitter, avg(time_tiktok) as tiktok"))->get();
         return $encuesta[0];
    }


    public function countRedesSociales()
    {
        $redesSociales = RedesSociales::all();
        $array = [];
        foreach ($redesSociales as $redSocial) {
            $encuesta = Encuesta::where("rs_favorita", "=", $redSocial->id)->get();
           array_push($array,[$redSocial->red_social => $encuesta->count()]);
        }
        return $array;
       

    }

    public function edadesRedesSociales()
    {
        $encuesta = Encuesta::select(DB::raw('edad , rs_favorita, count(rs_favorita) as conteo'))->join('participantes', 'participantes.id','=','encuesta.id_participante')->groupBy('edad' , 'rs_favorita')->get();
    return $encuesta;
    }
}
