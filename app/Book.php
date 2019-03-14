<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name','description', 'cover_image', 'author_id'
    ];

    public function tags() {
    	return $this->belongsToMany('App\Tag');
    }
    public function noTag() {
    	return Tag::whereNotIn('id', $this->tags->modelKeys())->get();
    }

    public function author() {
    	return $this->belongsTo('App\Author');
    }
}
