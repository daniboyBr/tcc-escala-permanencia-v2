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
    public function __construct()
    {
        $this->middleware('admin')->only(['liberarUsuario','liberarUsuarioComoAdmin','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $militar = Militar::with(['organizacao:id,nome'])
            ->where('email','!=','sistema@permanencia.com')
            ->paginate(5);

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

        if($request->has('password')){
            $request->merge(['password'=> Hash::make($request->get('password')) ]);
        }

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
        if((int)Auth::user()->isAdmin || Auth::user()->id == $id){
            $militar = Militar::findOrFail($id);
            $militar->password = '';

            return view('militar/create', [
                'militar' => $militar,
                'secao' => Secao::all(),
                'organizacao'=> OrganizacaoMilitar::all(['nome','id']),
                'graduacao' => PostoGraduacao::all('nome','id')
            ]);
        }

        abort(404);
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
        if((int)Auth::user()->isAdmin || Auth::user()->id == $id){
            
            if($request->filled('password')){
                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                $request->merge(['password'=> Hash::make($request->get('password')) ]);
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

            $militar->fill(array_filter($request->all()));

            if(!$militar->save()){
                return redirect()->back()->with('error','Não foi possivel salvar o militar.');
            }
    
            if(Auth::user()->isAdmin){
                return redirect()->route('militar-list')->with('success','Militar atualizado com sucesso!');
            }

            return redirect()->route('update-militar', ['id'=> $militar->id])
                ->with('success','Militar atualizado com sucesso!');
        }

        abort(404);
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
                'identidade' => ['required', 'string','numeric', 'max:20', 'unique:militar'],
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
