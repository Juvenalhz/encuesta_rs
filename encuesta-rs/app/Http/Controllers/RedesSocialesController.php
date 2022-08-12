<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RedesSociales;


class RedesSocialesController extends Controller
{
   
    public function index()
    {
        $redesSociales = RedesSociales::all();
        return $redesSociales;
    }


    public function store(Request $request)
    {
        //
    }

 
    public function show($id)
    {
        //
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
