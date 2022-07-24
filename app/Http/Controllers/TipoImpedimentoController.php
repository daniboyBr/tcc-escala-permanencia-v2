<?php

namespace App\Http\Controllers;

use App\Models\TipoImpedimento;
use Illuminate\Http\Request;

class TipoImpedimentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['create','edit','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tipo-impedimento/home', [
            'tipos' => TipoImpedimento::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipoImpedimento = new TipoImpedimento();

        if($request->isMethod('post')){
            
            $tipoImpedimento->fill($request->all());
            $tipoImpedimento->save();

            return redirect()->route('view-tipo-impedimento', ['id'=> $tipoImpedimento->id])
            ->with('success','Tipo de Impedimento cadastrado com sucesso!');
        }

        return view('tipo-impedimento/create',[
            'tipo' => $tipoImpedimento
        ]);
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
    public function show(int $id)
    {
        return view('tipo-impedimento/view', ['tipo' => TipoImpedimento::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoImpedimento  $tipoImpedimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $tipo =  TipoImpedimento::findOrFail($id);

        if($request->isMethod('put')){
            $tipo->fill($request->all());
            $tipo->save();

            return redirect()->route('view-tipo-impedimento', ['id'=> $tipo->id])
            ->with('success','Tipo de Impedimento atualizado com sucesso!');
        }


        return view('tipo-impedimento/edit', [
            'tipo' => $tipo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoImpedimento  $tipoImpedimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoImpedimento  $tipoImpedimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoImpedimento $tipoImpedimento)
    {
        //
    }
}
