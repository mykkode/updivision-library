<template>
	<div v-if = "fetched">
		<div class="container-fluid">
			<div class='wrapper'>
				<h3> Edit book: <div v-if="book" >{{ book.name }} ({{ id }})</div> </h3>
				<a class="btn btn-primary btn-sm" v-bind:href="'/books'">See all books</a>
	  		</div>
  		</div>
		<div>
			<form :action="'/books/'+id+'/alter'" method="POST">
				<input type="hidden" name="_token" :value="token_value">
				<!-- <input type="hidden" name="_token" value="57bZor8XBdKGxQjjgnKJvxmUHu2WKqlWp4Z6bmkb"> -->
				<div class="form-group">
					<label for="book_title">Title</label>
					<input type="text" name = "book_title" class="form-control" placeholder="Enter Title" :value=book.name>
					<div v-if = "errors.book_title" >
						<small v-for = "error_message in errors.book_title" id="passwordHelpBlock" class="form-text text-danger">
							{{ error_message }}
						</small>
					</div>
				</div>
				<div class="form-group">
				    <label for="book_author">Author</label>
				    <select name = "book_author" class="form-control" id="book_author" :value=book.author_id>
				    	<option :value=null></option>
						<option v-for="author in authors" :value=author.id>{{ author.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="tags_select">Tags</label>
				    <select name = "tags_select" class="form-control" id="tags_select" @change="addTag($event)">
				       <option value=0></option>
					   <option v-for="tag in tags" :value=tag.id type=submit><button type=submit>{{ tag.name }}</button></option>
					</select>
					<small>Tags are saved on the spot!</small>
					<div v-if = "book">
						<span v-for = "tag in book.tags" :title ="tag.description"  class="badge badge-warning">
							{{ tag.name }} <button class="btn btn-sm btn-danger " @click="removeTag( tag.id )" type=button>x</button>
						</span>
					</div>

				</div>
				<div class="form-group">
					<label for="book_description">Description</label>
					<textarea type="text" name = "book_description" class="form-control" placeholder="Enter Description" rows="10" :value=book.description></textarea>
					<div v-if = "errors.book_description" >
						<small v-for = "error_message in errors.book_description" id="passwordHelpBlock" class="form-text text-danger">
							{{ error_message }}
						</small>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
	<div v-else>
		Loading
	</div>
</template>

<script>
	export default {
		props: ['token_value', 'errors_string', 'id'],
		data: function() {
		  return {
		  	fetched :false,
		  	fetched_authors: false,
		  	fetched_book: false,
		  	book:null,
		  	authors:null,
		  	tags:null,
		  	errors: JSON.parse(this.errors_string)
		  }
		},
		beforeMount: function(){
			this.fetch_authors();
	    	this.fetch_book();
		},
		methods: {
			fetch_authors : function() {
	      		axios.get('/authors/list')
      			.then(response => {
      				this.authors = response.data.authors;
      				// console.log(this.authors );
      				this.fetched_authors = true;
      				this.checkAll();
      			});
		    },
		    fetch_book : function() {
	      		axios.get('/books/list/'+this.id)
      				.then(response => {
	      				this.book = response.data.books;
	      				this.tags = response.data.tags;
	      				this.fetched_book = true;
	      				this.checkAll();
	      				
	  			});
      		},
			addTag : function (event) {
				if(event.target.value != 0){
					axios.get('/books/bind/'+this.id+'/'+event.target.value);
		  			this.fetch_book();
				}
			},
			removeTag : function (tagId) {
					axios.get('/books/unbind/'+this.id+'/'+tagId);
		  			this.fetch_book();
			},
			checkAll: function () {
				if(this.fetched_authors && this.fetched_book){
					this.fetched = true;
				}
			},
			
		},
	}

</script>