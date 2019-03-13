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
    public function store(Request $request){
         $validatedData = $request->validate([
            'author_name' => 'required',
            'author_description' => 'required',
        ]);

        Author::create([
            'name' => $request->input('author_name'),
            'description' => $request->input('author_description')
        ]);

        return redirect('authors');
    }
    public function delete($id) {
    	$author = Author::find($id);
    	if($author){
    		Author::destroy($id);
    	}
    }
    public function edit($id) {
        $author = Author::find($id);
        if ($author){
            return view ('authorsEdit',['id' => $author->id,
                'name' => $author->name,
                'description' => $author->description]);
        }
    	
    }
    public function alter(Request $request, $id) {
        $validatedData = $request->validate([
            'author_name' => 'required',
            'author_description' => 'required',
        ]);

        $author = Author::find($id);
        $author->name = $request->input('author_name');
        $author->description = $request->input('author_description');
        $author->save();

        return redirect('authors');
    }
}
