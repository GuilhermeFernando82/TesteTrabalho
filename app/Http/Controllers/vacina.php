<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vacinaRegistro;
use Illuminate\Support\Facades\DB;
class vacina extends Controller
{
    public function add(Request $request)
    {
        $book = new vacinaRegistro([
            'fabricante' => $request->input('fabricante'),
            'lotes' => $request->input('lotes'),
            'datadeValidade' => $request->input('datadeValidade'),
            'numerosdeDoses' => $request->input('numerosdeDoses'),
            'intervaloDoses' => $request->input('intervaloDoses'),
        ]);
        
            $book->save();
            
            return response()->json(2);
        
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = vacinaRegistro::all()->toArray();
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
    public function store(Request $request)
    {
        //
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
        $question = vacinaRegistro::find($id);
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
        $book = vacinaRegistro::find($id);
        $book->delete();

        return response()->json('Deletado com sucesso!');
    }
}
