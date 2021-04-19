<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrovacinacao;
use Illuminate\Support\Facades\DB;
class registrovacina extends Controller
{
    public function add(Request $request)
    {
        $book = new registrovacinacao([
            'dataVacinacao' => $request->input('dataVacinacao'),
            'id_vacina' => $request->input('id_vacina'),
            'cpfId' => $request->input('cpfId'),
            'idDose' => $request->input('idDose'),
            
        ]);
        $verifiDose2 = DB::table('vacinaregistro')->where('idDose', $request->input('idDose'))->where('cpfId', $request->input('cpfId'))->where('id_vacina', $request->input('id_vacina'))->exists();
        $verificacao = DB::table('vacinaregistro')->where('idDose','<>',$request->input('idDose'))->where('cpfId', $request->input('cpfId'))->where('id_vacina', $request->input('id_vacina'))->exists();
        $verificacao2 = DB::table('vacinaregistro')->where('idDose',$request->input('idDose'))->where('cpfId',$request->input('cpfId'))->where('id_vacina',$request->input('id_vacina'))->exists();

        $verificpf = DB::table('vacinaregistro')->where('cpfId', $request->input('cpfId'))->where('id_vacina','<>',$request->input('id_vacina'))->exists();

        if($verifiDose2){
            return response()->json(1);
        }
        else if($verificacao){
            $book->save();

            return response()->json(3);
        }
        else if(!$verificacao2){
                if(!$verificpf){
                    $book->save();

                    return response()->json(3);
                }else{
                    return response()->json(1);
                }
               
            
           
        }else{
            return response()->json(1);
        }   
    }

    public function index()
    {
        $post = registrovacinacao::all()->toArray();
        return array_reverse($post);
    }

}
