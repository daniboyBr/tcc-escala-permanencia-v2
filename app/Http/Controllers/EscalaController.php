<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use Illuminate\Support\Facades\Storage;

class EscalaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// if(request()->hasFile('image')){
		// 	dd(request()->file('image')->store('upload'));
		// 	// return  Storage::download("upload/bkDdGgp7pqvhmnEsjdAZ9naHUrqfp2kXaNRz7nGi.bin","file.gp4");
		// 	// dd(Storage::url('upload/bkDdGgp7pqvhmnEsjdAZ9naHUrqfp2kXaNRz7nGi.bin'));

		// }
		return view('escala/index');
	}
}
