<template>
		<div class="tile is-parent">
        <article class="tile is-child is-info is-11">
		<h2 class="title is-2">Edit tag: {{ name }} ({{ id }})</h2>
		<div class = "content">
			<a class="button is-success" v-bind:href="'/tags/'">See all tags</a>
		</div>
		<form :action="'/tags/'+id+'/alter'" method="POST">
			<input type="hidden" name="_token" :value="token_value">
			
			<div class="field">
		        <label class="label">Name</label>
		        <div class="control has-icons-left">
		            <input id="tag_name" name="tag_name" class="input" type="text" placeholder="Tag Name" :value = "name" required>
		            <span class="icon is-small is-left">
		                <i class="fas fa-user"></i>
		            </span>
		        </div>
		        <div v-if = "errors.tag_name" >
					<p class="help is-danger" v-for = "error_message in errors.tag_name">
						{{ error_message }}
					</p>
				</div>
			</div>


				<div class="field">
		        <label class="label">Description</label>
		        <div class="control">
		            <textarea id="tag_description" name = "tag_description" class="textarea" type="text" placeholder="Enter Description" rows="10" :value = "description" required></textarea>
		        </div>
		        <div v-if = "errors.tag_description" >
					<p class="help is-danger" v-for = "error_message in errors.tag_description">
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
	export default {
		props: ['token_value', 'errors_string', 'id', 'name', 'description'],
		data: function() {
		  return {
		  	errors: JSON.parse(this.errors_string)
		  }
		},
	}
</script>