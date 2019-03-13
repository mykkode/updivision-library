<template>
<div>
	<div class="container-fluid">
		<div class='wrapper'>
			<h3> Authors </h3>
			<button class="btn btn-primary btn-sm" @click ="refresh()"><i class="fas  fa-refresh"></i>Reload Data</button>
			<a class="btn btn-primary btn-sm" v-bind:href="'/authors/add'">Add new</a>
  		</div>
  	</div>
  	<div v-if = "loading" >
  		LOADING
  	</div>
		<div v-else>
	    <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Author</th>
		      <th scope="col">Description</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for = "author in authors">
		      <td>{{ author.name }}</td>
			  <td>{{ author.description }}</td>
			  <td>
			  	<button class="btn brn-primary btn-sm" @click ="delete_author(author.id)"><i class="fas fa-trash"></i></button>
			  	<a class="btn btn-sm" v-bind:href="'/authors/'+author.id+'/edit'"><i class="fas fa-edit"></i></a>
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
		    authors: [],
		    loading: true
		  }
		},
		methods: {
			fetch_data: function() {
	      		axios.get('http://127.0.0.1:8000/authors/list')
      			.then(response => {
      				this.authors = response.data.authors;
      				// console.log(this.authors );
      			})
      			.finally(() => this.loading = false);
		    },
		    delete_author: function(id) {
		    	axios.post('/authors/'+id+'/delete')
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