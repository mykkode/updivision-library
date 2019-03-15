<template>
<div>
	<div class="tile is-parent">
        <article class="tile is-child is-info is-11">
		<h2 class="title is-2">Tags</h2>

	  	<div v-if = "loading" >
	  		LOADING
	  	</div>
		<div v-else>
			<div class = "content">
				<a class="button is-primary" @click ="refresh()"><i class="fas fa-refresh"></i>Reload Data</a>
				<a class="button is-success" v-bind:href="'/tags/add'">Add new</a>
			</div>
			<table class="table table is-fullwidth">
			  <thead>
			    <tr>
				  <th scope="col">Tag</th>
			      <th scope="col">Description</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tfoot>
				<tr v-for = "tag in tags">
			      <td>{{ tag.name }}</td>
				  <td>{{ tag.description }}</td>
				  <td>
				  	<a class="button" @click ="delete_tag(tag.id)">
					    <span class="icon is-small">
					      <i class="fas fa-trash"></i>
					    </span>
					</a>
					<a class="button" v-bind:href="'/tags/'+tag.id+'/edit'">
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