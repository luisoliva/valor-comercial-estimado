<?php

namespace App\Http\Controllers;

use App\Valuadora;
use App\Solicitudes;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ValuadoraController extends Controller
{
    public function Calculadora(){
        $colonias = Valuadora::all();
        return view('calculadora')->with(['colonias' => $colonias]);
    }
    public function Calculate(Request $request)
    {
        $user = Auth::user();
        if($user) {
            $solicitud = new Solicitudes();
            $solicitud->colonia = $request->colonia;
            $solicitud->m2_terreno = $request->terreno;
            $solicitud->m2_construido = $request->construido;
            $solicitud->acabados = $request->acabados;
            $solicitud->conservacion = $request->conservacion;
            $solicitud->saveOrFail();
            $solicitud2 = Solicitudes::latest()->take(1)->get();
            if ($solicitud2[0]->acabados == 'Muy mala') {
                $factor_1 = 0.86;
            } else if ($solicitud2[0]->acabados == 'Mala') {
                $factor_1 = 0.96;
            } else if ($solicitud2[0]->acabados == 'Normal') {
                $factor_1 = 1;
            } else if ($solicitud2[0]->acabados == 'Buena') {
                $factor_1 = 1.06;
            } else if ($solicitud2[0]->acabados == 'De lujo') {
                $factor_1 = 1.12;
            }
            if ($solicitud2[0]->conservacion == 'Muy mala') {
                $factor_2 = 0.92;
            } else if ($solicitud2[0]->conservacion == 'Mala') {
                $factor_2 = 0.96;
            } else if ($solicitud2[0]->conservacion == 'Normal') {
                $factor_2 = 1;
            } else if ($solicitud2[0]->conservacion == 'Buena') {
                $factor_2 = 1.02;
            } else if ($solicitud2[0]->conservacion == 'De lujo') {
                $factor_2 = 1.04;
            }
            $valorm2 = Valuadora::select('valor_metro2')->where('nombre_colonia', '=', $request->colonia)->get();
            $calculo = $solicitud2[0]->m2_terreno * $valorm2[0]->valor_metro2;
            $calculo += 3*$solicitud2[0]->m2_construido * $valorm2[0]->valor_metro2 * $factor_2 * $factor_1;
            return view('Calculado')->with(['calculo' => $calculo]);
        }
    }
    public function GenerarPDF(){
        $solicitud2 = Solicitudes::latest()->take(1)->get();
        if ($solicitud2[0]->acabados == 'Muy mala') {
            $factor_1 = 0.86;
        } else if ($solicitud2[0]->acabados == 'Mala') {
            $factor_1 = 0.96;
        } else if ($solicitud2[0]->acabados == 'Normal') {
            $factor_1 = 1;
        } else if ($solicitud2[0]->acabados == 'Buena') {
            $factor_1 = 1.06;
        } else if ($solicitud2[0]->acabados == 'De lujo') {
            $factor_1 = 1.12;
        }
        if ($solicitud2[0]->conservacion == 'Muy mala') {
            $factor_2 = 0.92;
        } else if ($solicitud2[0]->conservacion == 'Mala') {
            $factor_2 = 0.96;
        } else if ($solicitud2[0]->conservacion == 'Normal') {
            $factor_2 = 1;
        } else if ($solicitud2[0]->conservacion == 'Buena') {
            $factor_2 = 1.02;
        } else if ($solicitud2[0]->conservacion == 'De lujo') {
            $factor_2 = 1.04;
        }
        $valorm2 = Valuadora::select('valor_metro2')->where('nombre_colonia', '=', $solicitud2[0]->colonia)->get();
        $calculo = $solicitud2[0]->m2_terreno * $valorm2[0]->valor_metro2;
        $calculo += 3*$solicitud2[0]->m2_construido * $valorm2[0]->valor_metro2 * $factor_2 * $factor_1;
        $info = array('colonia'=>$solicitud2[0]->colonia,'terreno'=>$solicitud2[0]->m2_terreno,'construido'=>$solicitud2[0]->m2_construido,'acabados'=>$solicitud2[0]->acabados,'conservacion'=>$solicitud2[0]->conservacion,'calculo'=>$calculo);
        $pdf = PDF::loadView('textDoc',compact('info'));
        return $pdf->download('calculo.pdf');
    }
}