<template>
		<div class="tile is-parent">
        <article class="tile is-child is-info is-11">
		<h2 class="title is-2">Add Author</h2>
		<div class = "content">
			<a class="button is-success" v-bind:href="'/authors/'">See all authors</a>
		</div>
		<form action="/authors/store" method="POST">
			<input type="hidden" name="_token" :value="token_value">

			<div class="field">
		        <label class="label">Name</label>
		        <div class="control has-icons-left">
		            <input id="author_name" name="author_name" class="input" type="text" placeholder="Author Name" required>
		            <span class="icon is-small is-left">
		                <i class="fas fa-user"></i>
		            </span>
		        </div>
		        <div v-if = "errors.author_name" >
					<p class="help is-danger" v-for = "error_message in errors.author_name">
						{{ error_message }}
					</p>
				</div>
		    </div>
		    <div class="field">
		        <label class="label">Description</label>
		        <div class="control">
		            <textarea id="author_name" name = "author_description" class="textarea" type="text" placeholder="Author Description" rows="10" required></textarea>
		        </div>
		        <div v-if = "errors.author_description" >
					<p class="help is-danger" v-for = "error_message in errors.author_description">
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
	import axios from 'axios';
	export default {
		props: ['token_value', 'errors_string'],
		data: function() {
		  return {
		  	errors: JSON.parse(this.errors_string)
		  }
		},
	}
</script>