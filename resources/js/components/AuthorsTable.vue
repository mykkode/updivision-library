<template>
<div>
		<div class="tile is-parent">
        <article class="tile is-child is-info is-11">
	<h2 class="title is-2">Authors</h2>

  	<div v-if = "loading" >
  		LOADING
  	</div>
	<div v-else>
		<div class = "content">
			<a class="button is-primary" @click ="refresh()"><i class="fas  fa-refresh"></i>Reload Data</a>
			<a class="button is-success" v-bind:href="'/authors/add'">Add new</a>
		</div>
		<table class="table table is-fullwidth">
		  <thead>
		    <tr>
			  <th scope="col">Author</th>
		      <th scope="col">Description</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tfoot>
			<tr v-for = "author in authors">
		      <td>{{ author.name }}</td>
			  <td>{{ author.description }}</td>
			  <td>
			  	<a class="button" @click ="delete_author(author.id)">
				    <span class="icon is-small">
				      <i class="fas fa-trash"></i>
				    </span>
				</a>
				<a class="button" v-bind:href="'/authors/'+author.id+'/edit'">
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