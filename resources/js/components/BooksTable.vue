<template>
<div>
	<div class="container-fluid">
		<div class='wrapper'>
			<h3> Books </h3>
			<button class="btn btn-primary btn-sm" @click ="refresh()"><i class="fas  fa-refresh"></i>Reload Data</button>
			<a class="btn btn-primary btn-sm" v-bind:href="'/books/add'">Add new</a>
  		</div>
  	</div>
	  	<div v-if = "loading" >
	  		LOADING
	  	</div>
		<div v-else class="table-responsive">
	    <table class="table">
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
		  <tbody>
		    <tr v-for = "book in books">
		      <td>TODO</td>
		      <td>{{ book.name }}</td>
			  <td><span :title ="book.author.description" v-if="book.author" class="badge badge-info">{{ book.author.name }}</span></td>
			  <td><span :title ="tag.description" v-for = "tag in book.tags" class="badge badge-warning">{{ tag.name }}</span></td>
			  <td>{{ book.description }}</td>
			  <td>
			  	<button class="btn brn-primary btn-sm" @click ="delete_book(book.id)"><i class="fas fa-trash"></i></button>
			  	<a class="btn btn-sm" v-bind:href="'/books/'+book.id+'/edit'"><i class="fas fa-edit"></i></a>
			  </td>

		    </tr>
		  </tbody>
		</table>
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