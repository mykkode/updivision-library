<template>
<div>
	<div class="container-fluid">
		<div class='wrapper'>
			<h3> Tags </h3>
			<button class="btn btn-primary btn-sm" @click ="refresh()"><i class="fas  fa-refresh"></i>Reload Data</button>
			<a class="btn btn-primary btn-sm" v-bind:href="'/tags/add'">Add new</a>
  		</div>
  	</div>
  	<div v-if = "loading" >
  		LOADING
  	</div>
		<div v-else>
	    <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Tag</th>
		      <th scope="col">Description</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for = "tag in tags">
		      <td>{{ tag.name }}</td>
			  <td>{{ tag.description }}</td>
			  <td>
			  	<button class="btn brn-primary btn-sm" @click ="delete_tag(tag.id)"><i class="fas fa-trash"></i></button>
			  	<a class="btn btn-sm" v-bind:href="'/tags/'+tag.id+'/edit'"><i class="fas fa-edit"></i></a>
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
		    tags: [],
		    loading: true
		  }
		},
		methods: {
			fetch_data: function() {
	      		axios.get('http://127.0.0.1:8000/tags/list')
      			.then(response => {
      				this.tags = response.data.tags;
      				// console.log(this.tags );
      			})
      			.finally(() => this.loading = false);
		    },
		    delete_tag: function(id) {
		    	axios.post('/tags/'+id+'/delete')
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