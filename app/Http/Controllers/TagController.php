<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag as Tag;
class TagController extends Controller
{
    public function index() {
    	return view("tags");
    }
    public function list() {
    	return response()->json(["tags" => Tag::all()]);
    }
    public function add(){
    	return view("tagsAdd");
    }
    public function store(Request $request){
         $validatedData = $request->validate([
            'tag_name' => 'required',
            'tag_description' => 'required',
        ]);

        Tag::create([
            'name' => $request->input('tag_name'),
            'description' => $request->input('tag_description')
        ]);

        return redirect('tags');
    }
    public function delete($id) {
    	$tag = Tag::find($id);
    	if($tag){
    		Tag::destroy($id);
    	}
    }
    public function edit($id) {
        $tag = Tag::find($id);
        if ($tag){
            return view ('tagEdit',['id' => $tag->id,
                'name' => $tag->name,
                'description' => $tag->description]);
        }
    	
    }
    public function alter(Request $request, $id) {
        $validatedData = $request->validate([
            'tag_name' => 'required',
            'tag_description' => 'required',
        ]);

        $tag = Tag::find($id);
        $tag->name = $request->input('tag_name');
        $tag->description = $request->input('tag_description');
        $tag->save();

        return redirect('tag');
    }
}
