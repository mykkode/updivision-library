<template>
	<div>
		<div class="container-fluid">
			<div class='wrapper'>
				<h3> Add Book </h3>
				<a class="btn btn-primary btn-sm" v-bind:href="'/books'">See all Books</a>
	  		</div>
  		</div>
		<div>
			<form action="/books/store" method="POST">
				<input type="hidden" name="_token" :value="token_value">
				<!-- <input type="hidden" name="_token" value="57bZor8XBdKGxQjjgnKJvxmUHu2WKqlWp4Z6bmkb"> -->
				<div class="form-group">
					<label for="book_title">Title</label>
					<input type="text" name = "book_title" class="form-control" placeholder="Enter Title">
					<div v-if = "errors.book_title" >
						<small v-for = "error_message in errors.book_title" id="passwordHelpBlock" class="form-text text-danger">
							{{ error_message }}
						</small>
					</div>
				</div>
				<div class="form-group">
				    <label for="book_author">Author</label>
				    <select name = "book_author" class="form-control" id="book_author">
				    	<option :value=0></option>
						<option v-for="author in authors" :value=author.id>{{ author.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="book_description">Description</label>
					<textarea type="text" name = "book_description" class="form-control" placeholder="Enter Description" rows="10"></textarea>
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
</template>

<script>
	import axios from 'axios';
	export default {
		props: ['token_value', 'errors_string'],
		data: function() {
		  return {
		  	authors: null,
		  	errors: JSON.parse(this.errors_string)
		  }
		},
		methods:{
			fetch_authors: function() {
	      		axios.get('http://127.0.0.1:8000/authors/list')
      			.then(response => {
      				this.authors = response.data.authors;
      				// console.log(this.authors );
      			});
		    },
		},
		beforeMount(){
		    this.fetch_authors()
		},
	}
</script>