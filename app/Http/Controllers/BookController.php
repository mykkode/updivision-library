<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book as Book;
use App\Tag as Tag;
use DB;
class BookController extends Controller
{
    public function index() {
    	return view("books");
    }
    public function list($id = null) {
        if(is_null($id)){
            return response()->json(["books" => Book::with('author')->with('tags')->get()]);
        }            
    	else {
            $book = Book::with('author')->with('tags')->where('id', '=', $id)->first();
            $tags = $book->noTag();
            return response()
            ->json([
                "books" => $book,
                "tags" => $tags
            ]);
        }
    }
    public function add(){
    	return view("booksAdd");
    }
    public function bind($book_id, $tag_id){
        $check = DB::table('book_tag')
        ->where('book_id', '=', $book_id)
        ->where('tag_id', '=', $tag_id)
        ->get();
        if($check->isEmpty()){
            DB::table('book_tag')
                ->insert([
                    'book_id' => $book_id, 
                    'tag_id' => $tag_id, 
                ]);
        }
        $target = "books/" . $book_id . "/edit";
    }
    public function unbind($book_id, $tag_id){
        $check = DB::table('book_tag')
        ->where('book_id', '=', $book_id)
        ->where('tag_id', '=', $tag_id)
        ->get();
        if(!$check->isEmpty()){
            DB::table('book_tag')
                ->where('book_id', '=', $book_id) 
                ->where('tag_id', '=', $tag_id) 
                ->delete();
        }
    }
    public function store(Request $request){
         $validatedData = $request->validate([
            'book_title' => 'required',
            'book_description' => 'required',
            'book_author' => 'nullable|exists:authors,id',
        ]);

        Book::create([
            'name' => $request->input('book_title'),
            'description' => $request->input('book_description'),
            'author_id' => $request->input('book_author'),
            'cover_image' => "none.png"
        ]);

        return redirect('books');
    }
    public function delete($id) {
    	$book = Book::find($id);
        if($book){
    		Book::destroy($id);
    	}
    }
    public function edit($id) {
        $book = Book::find($id);
        if ($book){
            return view ('booksEdit',['id' => $book->id,
                'name' => $book->name,
                'description' => $book->description]);
        }
    }
    public function alter(Request $request, $id) {
        $validatedData = $request->validate([
            'book_title' => 'required',
            'book_description' => 'required',
            'book_author' => 'nullable|exists:authors,id',
            'book_image' => 'nullable|image'
           
        ]);

        $book = Book::find($id);

        if($request->book_image) {
            $name = $id.'.'.$request->book_image->getClientOriginalExtension();
            $request->book_image->storeAs('covers', $name, 'public');
            $book->cover_image = $name;
        }
        
        $book->name = $request->input('book_title');
        $book->description = $request->input('book_description');
        $book->author_id = $request->input('book_author');
        $book->save();

        return redirect('books');
    }
}
