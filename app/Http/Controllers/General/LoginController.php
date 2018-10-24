<?php 

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Post;

class LoginController extends Controller{


	public function index(){
		return view('principal.pages.inicio');
	}


}