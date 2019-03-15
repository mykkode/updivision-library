<template>
<div>
	<div class="tile is-parent">
        <article class="tile is-child is-info is-11">
		<h2 class="title is-2">Books</h2>

	  	<div v-if = "loading" >
	  		LOADING
	  	</div>
		<div v-else>
			<div class = "content">
				<a class="button is-primary" @click ="refresh()"><i class="fas fa-refresh"></i>Reload Data</a>
				<a class="button is-success" v-bind:href="'/books/add'">Add new</a>
			</div>
			<table class="table table is-fullwidth">
			  <thead>
			    <tr>
					<th scope="col">Cover</th>
					<th scope="col">Title</th>
					<th scope="col">Author</th>
					<th scope="col">Tags</th>
					<th scope="col">Description</th>
					<th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tfoot>
				<tr v-for = "book in books">
				  <td><figure class="image is-128x128">
					  <img :src="'/storage/covers/'+ book.cover_image">
					</figure>
				 </td>
			      <td>{{ book.name }}</td>
				  <td>
					  <span v-if="book.author" :title="book.author.description" class="tag is-primary">{{ book.author.name }}</span>
				  </td>
				  <td><span v-for="tag in book.tags" :title="tag.description" class="tag is-warning">{{ tag.name }}</span></td>
				  <td>{{ book.description }}</td>
				  <td>
				  	<a class="button" @click ="delete_book(book.id)">
					    <span class="icon is-small">
					      <i class="fas fa-trash"></i>
					    </span>
					</a>
					<a class="button" v-bind:href="'/books/'+book.id+'/edit'">
						<span class="icon is-small">
					  		<i class="fas fa-edit"></i>
						</span>
					</a>
				  </td>
		      </tr>
			  </tfoot>
			</table>
		</div>
		        </article>
      </div>
</div>
</template>

<script>
	import axios from 'axios';
	export default {
		data: function() {
		  return {
		    books: [],
		    loading: true
		  }
		},
		methods: {
			fetch_data: function() {
	      		axios.get('http://127.0.0.1:8000/books/list')
      			.then(response => {
      				this.books = response.data.books;
      				// console.log(this.books );
      			})
      			.finally(() => this.loading = false);
		    },
		    delete_book: function(id) {
		    	axios.post('/books/'+id+'/delete')
      			.then(response => {
      				this.loading = false;
      				this.fetch_data();
      			});
		    },
		    refresh: function() {
		    	this.fetch_data();
		    }
		},
		beforeMount(){
		    this.fetch_data()
		},

	}
</script>