<template>
	<div class="tile is-parent">
        <article class="tile is-child is-info is-6">
		<div v-if = "fetched" class="">
			<h2 class="title is-2" v-if="book" >EditBook: {{ book.name }} ({{ id }})</h2>
			<div class = "content">
				<a class="button is-success" v-bind:href="'/books'">See all Books</a>
			</div>
			<form :action="'/books/'+id+'/alter'" method="POST">
				<input type="hidden" name="_token" :value="token_value">

				<div class="field">
			        <label class="label">Title</label>
			        <div class="control has-icons-left">
			            <input id="book_title" name="book_title" class="input" type="text" placeholder="Book Title" :value=book.name required>
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
				  <div class="control has-icons-left">
				    <div class="select">
						<select name = "book_author" id="book_author" :value=book.author_id>
							<option :value=null></option>
							<option v-for="author in authors" :value=author.id>{{ author.name }}</option>
						</select>
						<span class="icon is-small is-left">
			                <i class="fas fa-pen"></i>
			            </span>
				    </div>
				  </div>
				</div>

				<div class="field">
				  <label class="label">Tags</label>
				  <div class="control has-icons-left ">
				    <div class="select">
						<select name = "book_tags" id="book_tags"  @change="addTag($event)">
							<option value=null></option>
							<option v-for="tag in tags" :value=tag.id type=submit>{{ tag.name }}</option>
						</select>
						<span class="icon is-small is-left">
			                <i class="fas fa-tag"></i>
			            </span>
				    </div>
				  </div>
				  <p class="help is-info">
						Tags are saved on the spot. You don't need to save anything!
					</p>
				  	<div v-if = "book">
				  		<span :title ="tag.description" v-for = "tag in book.tags" class="tag is-warning">
						  {{ tag.name }}
						  <button class="delete is-small" @click="removeTag( tag.id )"></button>
						</span>

					</div>

				</div>
								
				<div class="field">
			        <label class="label">Description</label>
			        <div class="control">
			            <textarea id="book_description" name = "book_description" class="textarea" type="text" placeholder="Enter Description" rows="10" :value=book.description required></textarea>
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
		</div>
		<div v-else>
			Loading
		</div>
	        </article>
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