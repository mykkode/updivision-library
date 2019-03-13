<template>
<div>
		<div class="container-fluid">
			<div class='wrapper'>
				<h3> Edit Author: {{ name }} ({{ id }}) </h3>
				<a class="btn btn-primary btn-sm" v-bind:href="'/authors'">See all authors</a>
	  		</div>
  		</div>
		<div>
			<form :action="'/authors/'+id+'/alter'" method="POST">
				<input type="hidden" name="_token" :value="token_value">
				<!-- <input type="hidden" name="_token" value="57bZor8XBdKGxQjjgnKJvxmUHu2WKqlWp4Z6bmkb"> -->
				<div class="form-group">
					<label for="author_name">Name</label>
					<input type="text" name = "author_name" class="form-control" placeholder="Enter Name" :value = "name">
					<div v-if = "errors.author_name" >
						<small v-for = "error_message in errors.author_name" id="passwordHelpBlock" class="form-text text-danger">
							{{ error_message }}
						</small>
					</div>
				</div>
				<div class="form-group">
					<label for="author_description">Description</label>
					<textarea type="text" name = "author_description" class="form-control"placeholder="Enter Description" rows="10" :value = "description"></textarea>
					<div v-if = "errors.author_description" >
						<small v-for = "error_message in errors.author_description" id="passwordHelpBlock" class="form-text text-danger">
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
	export default {
		props: ['token_value', 'errors_string', 'id', 'name', 'description'],
		data: function() {
		  return {
		  	errors: JSON.parse(this.errors_string)
		  }
		},
	}
</script>