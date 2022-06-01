<?php

namespace App\Http\Controllers;

use App\Models\PostoGraduacao;
use Illuminate\Http\Request;

class PostoGraduacaoController extends Controller
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
        return view('posto-graduacao/home', ['postos' => PostoGraduacao::paginate(5)]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $posto = new PostoGraduacao();

        if($request->isMethod('post')){
            $posto->fill($request->all());
            $posto->save();

            return redirect()->route('view-graduacao', ['id'=> $posto->id])
            ->with('success','Posto de Gradução cadastrado com sucesso!');
        }

        return view('posto-graduacao/create', [
            'posto' => $posto
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostoGraduacao  $postoGraduacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('posto-graduacao/view', ['posto' => PostoGraduacao::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostoGraduacao  $postoGraduacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,int $id)
    {
        $posto = PostoGraduacao::findOrFail($id);

        if($request->isMethod('put')){
            $posto->fill($request->all());
            $posto->save();

            return redirect()->route('view-graduacao', ['id'=> $posto->id])
            ->with('success','Posto de Gradução atualizado com sucesso!');
        }

        return view('posto-graduacao/edit', [
            'posto' => $posto
        ]);
    }
}
