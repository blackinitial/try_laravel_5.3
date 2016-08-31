<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB; // bila memakai Database

class indexcontroller extends Controller
{
    function index() {
    	return view('login', array(
    		'title' => 'Login' // Login mengisi variable di file view(html)
    		));
    }

    function getUser() {

    	$data = DB::table('users') // DB harus memanggil DB
    		->get();

    	/*$data = array();
    	$data['code'] = 200;
    	$data['content'] = array('username' => 'Pondok Programmer');
*/
    	return response($data); //json_encode utk syntak php response
    }
}
