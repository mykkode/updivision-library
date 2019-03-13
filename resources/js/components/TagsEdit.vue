<template>
<div>
		<div class="container-fluid">
			<div class='wrapper'>
				<h3> Edit tag: {{ name }} ({{ id }}) </h3>
				<a class="btn btn-primary btn-sm" v-bind:href="'/tags'">See all tags</a>
	  		</div>
  		</div>
		<div>
			<form :action="'/tags/'+id+'/alter'" method="POST">
				<input type="hidden" name="_token" :value="token_value">
				<!-- <input type="hidden" name="_token" value="57bZor8XBdKGxQjjgnKJvxmUHu2WKqlWp4Z6bmkb"> -->
				<div class="form-group">
					<label for="tag_name">Name</label>
					<input type="text" name = "tag_name" class="form-control" placeholder="Enter Name" :value = "name">
					<div v-if = "errors.tag_name" >
						<small v-for = "error_message in errors.tag_name" id="passwordHelpBlock" class="form-text text-danger">
							{{ error_message }}
						</small>
					</div>
				</div>
				<div class="form-group">
					<label for="tag_description">Description</label>
					<textarea type="text" name = "tag_description" class="form-control"placeholder="Enter Description" rows="10" :value = "description"></textarea>
					<div v-if = "errors.tag_description" >
						<small v-for = "error_message in errors.tag_description" id="passwordHelpBlock" class="form-text text-danger">
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