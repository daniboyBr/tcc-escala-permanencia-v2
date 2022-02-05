<?php

namespace App\Http\Controllers;

use App\Models\Secao;

class EscalaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('escala/index');
	}
}
