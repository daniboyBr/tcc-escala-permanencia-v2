<?php

namespace App\Http\Controllers;

use App\Models\OrganizacaoMilitar;
use Illuminate\Http\Request;

class OrganizacaoMilitarController extends Controller
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
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\OrganizacaoMilitar  $organizacaoMilitar
	 * @return \Illuminate\Http\Response
	 */
	public function show(OrganizacaoMilitar $organizacaoMilitar)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\OrganizacaoMilitar  $organizacaoMilitar
	 * @return \Illuminate\Http\Response
	 */
	public function edit(OrganizacaoMilitar $organizacaoMilitar)
	{
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\OrganizacaoMilitar  $organizacaoMilitar
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, OrganizacaoMilitar $organizacaoMilitar)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\OrganizacaoMilitar  $organizacaoMilitar
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(OrganizacaoMilitar $organizacaoMilitar)
	{
	}

	public function secao(int $organizacao)
	{
		if (!$organizacao) {
			return [];
		}

		$org = OrganizacaoMilitar::find($organizacao);

		if (!$org) {
			return [];
		}

		$secao = $org->secao()->where('flgAtivo', 1)->get(['id', 'nome']);
	
		return ['secao' => $secao];
	}
}
