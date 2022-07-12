<?php

namespace App\Http\Controllers;

use App\Models\PostoGraduacao;
use App\Models\PostoGraduacaoPostoServico;
use App\Models\PostoServico;
use Illuminate\Http\Request;

class PostoGraduacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['create','edit','update','destroy','postoServico']);
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
            if($posto->save()){

                return redirect()->route('view-graduacao', ['id'=> $posto->id])
                    ->with('success','Posto de Gradução cadastrado com sucesso!');
            }

            return redirect()->route('view-graduacao', ['id'=> $posto->id])
                ->with('error','Erro ao salvar o posto de Graduação.');
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
            if($posto->save()){

                return redirect()->route('view-graduacao', ['id'=> $posto->id])
                    ->with('success','Posto de Gradução atualizado com sucesso!');
            }
 
            return redirect()->route('view-graduacao', ['id'=> $posto->id])
            ->with('error','Erro ao atualizar o Posto de Gradução.');
        }

        return view('posto-graduacao/edit', [
            'posto' => $posto
        ]);
    }

    public function viewPgPostoServico(Request $request, $id)
    {
        $pgPostoServico = PostoGraduacaoPostoServico::findOrFail($id);

        return view('indicar-graduacao/view', [
            'graduacao' => PostoGraduacao::where('flgAtivo',1)->get(),
            'servicos' => PostoServico::where('flgAtivo',1)->get(),
            'pgPostoServico' => $pgPostoServico
        ]);
    }

    public function postoServico(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'postoGraduacao_id' => 'required|exists:postoGraduacao,id',
                'postoServico_id' => 'required|exists:postoServico,id'
            ],[
                'required'=> 'Campo Posto de Graduação, Posto de Serviço são obrigatórios',
                'exists'=> 'Campo Posto de Graduaçao, Posto de Serviço devem existir na base de dados.'
            ]);
    

            $graducao = PostoGraduacao::findOrFail($request->get('postoGraduacao_id')); 
            $servico = PostoServico::findOrFail($request->get('postoServico_id')); 

            $pgPostoServico = PostoGraduacaoPostoServico::create([
                'postoGraduacao_id' => $graducao->id,
                'postoServico_id' => $servico->id
            ]);

            if($pgPostoServico){
                return redirect()->route('view-graduacao-servico', ['id'=> $pgPostoServico->id])
                    ->with('success','Indicação realizada com sucesso!');
            }

            return redirect()->route('graduacao-servico', ['id'=> $pgPostoServico->id])
                ->with('error','Indicação realizada com sucesso.');
        }


        return view('indicar-graduacao/create', [
            'graduacao' => PostoGraduacao::where('flgAtivo',1)->get(),
            'servicos' => PostoServico::where('flgAtivo',1)->get(),
            'pgPostoServico' => new PostoGraduacaoPostoServico()
        ]);
    }
}
