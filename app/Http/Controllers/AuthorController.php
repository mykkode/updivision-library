<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author as Author;
class AuthorController extends Controller
{
    public function index() {
    	return view("authors");
    }
    public function list() {
    	return response()->json(["authors" => Author::all()]);
    }
    public function add(){
    	return view("authorsAdd");
    }
    public function delete($id) {
    	$author = Author::find($id);
    	if($author){
    		Author::destroy($id);
    	}
    }
    public function edit() {
    	
    }
}
