<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\Impedimento;
use Illuminate\Http\Request;

class ImpedimentoController extends Controller
{
    public function __construct()
	{
		$this->middleware('admin')->only(['create', 'edit', 'update', 'destroy']);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('impedimento/index', [
            'militares' => Militar::where('nomeGuerra','!=','System')->paginate(5, ['nomeGuerra', 'email', 'id'])
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $militar_id)
    {
        $militar = Militar::findOrFail($militar_id);
        $impedimento = new Impedimento();
        $impedimento->militar_id = $militar->id;

        return view('impedimento/create', [
            'militar' => $militar,
            'impedimento' => $impedimento
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $militar_id)
    {

        if(!$request->get('militar_id','') || $request->get('militar_id','') != $militar_id){
            return redirect()->back()->with('error','Militar não encontrado.');
        }

        $request->validate([
            'militar_id' => 'required|exists:militar,id',
            'dataInicio' => 'required|date_format:Y-m-d|after_or_equal:today',
            'dataFinal' => 'required|date_format:Y-m-d|after_or_equal:dataInicio',
            'arquivo' => 'required|file|mimes:pdf'
        ],[
            'required'=> 'Campo Data Início, Data Final, e Arquivo é obrigatorio.',
            'date_format'=> 'Datas devem estar no padrão DD/MM/AAAA',
            'after_or_equal'=> 'Data deve ser maior ou igual a data de hoje.',
            'mimes'=> 'Arquivo deve estar no formado .pdf'
        ]);


        $path = $request->arquivo->store('impedimento');
        $request = new Request($request->except('arquivo'));
        $request->merge(['arquivo' => $path]);

        $impedimento = new Impedimento();
        $impedimento->fill($request->all());
        $impedimento->save();

        return redirect()->route('militar-impedimento')
                                ->with('success','Impedimento cadastrado com sucesso!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $militar_id)
    {
        $militar = Militar::findOrFail($militar_id);

        // dd($militar->impedimentos);
        return view('impedimento/view', [
            'militar' => $militar
        ]); 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
