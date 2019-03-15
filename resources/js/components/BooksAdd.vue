
<template>
		<div class="tile is-parent">
        <article class="tile is-child is-info is-6">
		<h2 class="title is-2">Add Book</h2>
		<div class = "content">
			<a class="button is-success" v-bind:href="'/books'">See all Books</a>
		</div>
		<form action="/books/store" method="POST">
			<input type="hidden" name="_token" :value="token_value">
			<div class="field">
		        <label class="label">Title</label>
		        <div class="control has-icons-left">
		            <input id="book_title" name="book_title" class="input" type="text" placeholder="Book Title" required>
		            <span class="icon is-small is-left">
		                <i class="fas fa-book"></i>
		            </span>
		        </div>
		        <div v-if = "errors.book_title" >
					<p class="help is-danger" v-for = "error_message in errors.book_title">
						{{ error_message }}
					</p>
				</div>
			</div>

			<div class="field">
			  <label class="label">Author</label>
			  <div class="control">
			    <div class="select">
					<select name = "book_author" id="book_author">
						<option :value=null></option>
						<option v-for="author in authors" :value=author.id>{{ author.name }}</option>
					</select>
			    </div>
			  </div>
			</div>
							
			<div class="field">
		        <label class="label">Description</label>
		        <div class="control">
		            <textarea id="book_description" name = "book_description" class="textarea" type="text" placeholder="Enter Description" rows="10" required></textarea>
		        </div>
		        <div v-if = "errors.book_description" >
					<p class="help is-danger" v-for = "error_message in errors.book_description">
						{{ error_message }}
					</p>
				</div>
			</div>
			<div class="field is-grouped">
		        <div class="control">
		            <button type="submit" class="button is-link">Submit</button>
		        </div>
		    </div>
			</form>
		        </article>
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