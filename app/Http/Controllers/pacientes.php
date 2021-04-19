<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pacientesVacinas;
use Illuminate\Support\Facades\DB;
class pacientes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = pacientesVacinas::all()->toArray();
        return array_reverse($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $book = new pacientesVacinas([
            'name' => $request->input('name'),
            'cpf' => $request->input('cpf'),
            'datadeNascimento' => $request->input('datadeNascimento'),
            'Email' => $request->input('email'),
        ]);
        $verifiEmail = DB::table('pacientes')->where('Email', $request->input('email'))->exists();
        $verifiCpf = DB::table('pacientes')->where('cpf', $request->input('cpf'),)->exists();
        if($verifiCpf || $verifiEmail){
            return response()->json(1);
        }else{
            $book->save();
            
            return response()->json(2);
        }
        
    }
    public function store(Request $request, pacientesVacinas $pacientes)
    {
         $request->validate([
                'name' => 'required',
                'cpf' => 'required',
                'datadeNascimento' => 'required',
                'Email' => 'required',
         ]);

        $pacientes->name = $request->name;
        $pacientes->cpf = $request->cpf;
        $pacientes->datadeNascimento = $request->datadeNascimento;
        $pacientes->Email = $request->Email;
        
    

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = pacientesVacinas::find($id);
        $question->update($request->all());

        return response()->json('Atualizado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = pacientesVacinas::find($id);
        $book->delete();

        return response()->json('Deletado com sucesso!');
    }
}
