<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use App\Models\Militar;
use Illuminate\Http\Request;
use App\Models\PostoGraduacao;
use App\Models\OrganizacaoMilitar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MilitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $militar = Militar::with(['organizacao:id,nome'])->paginate(5);
        return view('militar/index',[
            'militar'=> $militar
        ]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::user()->militar_id){
            return redirect()->route('update-militar', ['id'=> Auth::user()->militar_id]);
        }

        $militar = new Militar();
        $militar->nome = $request->user()->name;
        $militar->email = $request->user()->email;

        return view('militar/create', [
            'militar' => $militar,
            'secao' => Secao::all(),
            'organizacao'=> OrganizacaoMilitar::all(['nome','id']),
            'graduacao' => PostoGraduacao::all(['nome','id'])
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
        $militar = new Militar();

        if($request->hasFile('imagem')){
            $path = $request->imagem->store('militar');
            $request = new Request($request->except('imagem'));
            $request->merge(['imagem' => $path]);
        }

        $request->merge(['telefoneResidencial' => preg_replace('/[^0-9]/','',$request->get('telefoneResidencial',''))]);
        $request->merge(['telefoneCelular' => preg_replace('/[^0-9]/','',$request->get('telefoneCelular',''))]);

        $militar->fill($request->all());

        if(!$militar->save()){
            Storage::delete($militar->imagem);
            return redirect()->back()->with('error','Erro ao tentar salvar o militar');
        }

        return redirect()->route('update-militar', ['id'=> $militar->id])
            ->with('success','Militar cadastrado com sucesso!');
    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Militar  $militar
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if(Auth::user()->militar_id != $id){
            abort(404);
        }

        $militar = Militar::findOrFail($id);

        return view('militar/create', [
            'militar' => $militar,
            'secao' => Secao::all(),
            'organizacao'=> OrganizacaoMilitar::all(['nome','id']),
            'graduacao' => PostoGraduacao::all('nome','id')
        ]);
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Militar  $militar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        if(Auth::user()->militar_id != $id){
            abort(404);
        }

        $militar = Militar::findOrFail($id);

        if($request->hasFile('imagem')){
            $path = $request->imagem->store('militar');
            $request = new Request($request->except('imagem'));
            $request->merge(['imagem' => $path]);

            if($militar->imagem){
                Storage::delete($militar->imagem);
            }
        }

        $request->merge(['telefoneResidencial' => preg_replace('/[^0-9]/','',$request->get('telefoneResidencial',''))]);
        $request->merge(['telefoneCelular' => preg_replace('/[^0-9]/','',$request->get('telefoneCelular',''))]);

        $militar->fill($request->all());
        $militar->save();

        return redirect()->route('update-militar', ['id'=> $militar->id])
            ->with('success','Militar atualizado com sucesso!');
    }

    public function liberarUsuario(Request $request)
    {   
        $response = [];
        try{
            $usuario = Militar::find($request->get('id',''));
            $usuario->flgAtivo = !$usuario->flgAtivo;
            $usuario->save();
            $response = [
                'result'=> true,
                'status' => $usuario->flgAtivo,
                'message' => 'Registro alterado com sucesso.'
            ];
        }catch(\Exception $e){
            $response = [
                'result'=> false,
                'message' => 'Requisição nao processada! Ocorreu um erro ao tentar salvar o registro.'
            ];
        }

        return response()->json($response);

    }

    
    public function liberarUsuarioComoAdmin(Request $request)
    {
        $response = [];
        try{
            $usuario = Militar::find($request->get('id',''));
            $usuario->isAdmin = !$usuario->isAdmin;
            $usuario->save();
            $response = [
                'result'=> true,
                'status' => $usuario->isAdmin,
                'message' => 'Registro alterado com sucesso.'
            ];
        }catch(\Exception $e){
            $response = [
                'result'=> false,
                'message' => 'Requisição nao processada! Ocorreu um erro ao tentar salvar o registro.'
            ];
        }

        return response()->json($response);
    }

    public function createNewUserWithMilitar(Request $request)
    {
        $militar = new Militar();

        if($request->isMethod('post')){ 
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:militar'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if($request->hasFile('imagem')){
                $path = $request->imagem->store('militar');
                $request = new Request($request->except('imagem'));
                $request->merge(['imagem' => $path]);
            }

            $request->merge(['telefoneResidencial' => preg_replace('/[^0-9]/','',$request->get('telefoneResidencial',''))]);
            $request->merge(['telefoneCelular' => preg_replace('/[^0-9]/','',$request->get('telefoneCelular',''))]);
            $request->merge(['password'=> Hash::make($request->get('password')) ]);

            $militar->fill($request->all());

            if(!$militar->save()) {
                Storage::delete($militar->imagem);
                return redirect()->back()->with('error','Erro ao cadastrar o militar.');
            }

            return redirect()
                ->route('militar-list')
                ->with('success','Militar cadastrado com sucesso.');
        }

        return view('militar/new', [
            'militar' => $militar,
            'secao' => Secao::all(),
            'organizacao'=> OrganizacaoMilitar::all(['nome','id']),
            'graduacao' => PostoGraduacao::all('nome','id')
        ]);
    }
}
