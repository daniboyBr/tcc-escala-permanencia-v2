<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use Illuminate\Http\Request;
use App\Models\OrganizacaoMilitar;

class SecaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secao/home', ['secao' => Secao::with('organizacao')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $secao = new Secao();

        if($request->isMethod('post')){
            $secao->fill($request->all());
            $secao->save();

            return redirect()->route('view-secao', ['id'=> $secao->id])
            ->with('success','Seção cadastrada com sucesso!');
        }

        return view('secao/create', [
            'secao' => $secao,
            'organizacao' => OrganizacaoMilitar::all(['nome','id'])
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
     * @param  \App\Models\Secao  $secao
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('secao/view', [
            'secao' => Secao::findOrFail($id),
            'organizacao' => OrganizacaoMilitar::all(['nome','id'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secao  $secao
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $id)
    {
        $secao = Secao::findOrFail($id);

        if($request->isMethod('put')){
            $secao->fill($request->all());
            $secao->save();

            return redirect()->route('view-secao', ['id'=> $secao->id])
            ->with('success','Seção atualizado com sucesso!');
        }

        return view('secao/edit', [
            'secao' => $secao,
            'organizacao' => OrganizacaoMilitar::all(['nome','id'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secao  $secao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secao $secao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secao  $secao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secao $secao)
    {
        //
    }
}
