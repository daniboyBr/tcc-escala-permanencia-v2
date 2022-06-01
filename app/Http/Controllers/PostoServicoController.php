<?php

namespace App\Http\Controllers;

use App\Models\PostoServico;
use Illuminate\Http\Request;

class PostoServicoController extends Controller
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
        return view('posto-servico/home', ['postos' => PostoServico::paginate(5)]);
    }

    public function getPostoServico(Request $request,int $id)
    {
        return view('posto-servico/view', ['posto' => PostoServico::findOrFail($id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNewPostoServico(Request $request)
    {
        $posto = new PostoServico();

        if($request->isMethod('post')){

            $posto->fill($request->all());
            $posto->save();

            return redirect()->route('view-posto', ['id'=> $posto->id])
                ->with('success','Posto de Serviço cadastrado com sucesso!');
        }

        return view('posto-servico/create', ['posto' => $posto]);
    }

    public function updatePostoServico(Request $request,int $id)
    {
        $posto =  PostoServico::findOrFail($id);

        if($request->isMethod('put')){

            $posto->nome = $request->input('nome');
    
            $posto->save();

            return redirect()->route('view-posto', ['id'=> $posto->id])
                ->with('success','Posto de Serviço cadastrado com sucesso!');
        }
        
        return view('posto-servico/edit', ['posto' => $posto]);
    }
}
