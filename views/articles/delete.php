<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/form.css">
<main>
	
<h2>Delete Article</h2>

<form method="POST" action="../deletePost">
	<input type="hidden" name="id" value="<?=$this->article->id?>">
	<fieldset class="col-lg-12">
		<legend>Delete Article</legend>
		<div class="form-group col-lg-12">
			<label for="txt_title">Title</label>
			<input class="form-control" id="title" value="<?=$this->article->title?>" type="text" name="title" disabled>
		</div>
		<div class="form-group col-lg-12">
			<label for="txt_body">Body</label>
			<textarea value="<?=$this->article->body?>" class="form-control" rows="5" id="body" type="text" name="body" disabled></textarea>
		</div>
		<div class="form-group col-lg-12">
		    <label for="image_url">Image</label>
		    <input value="<?=$this->article->image_url?>" type="file" class="form-control-file" id="image_url" disabled>
		</div>
		<div class="form-group col-lg-12">
			<label class="control-label" for="date">Publish Date</label>
	        <input value="<?=isset($this->article->publish_date)?$this->article->publish_date:""?>" class="form-control" id="date" name="publish_date" placeholder="MM/DD/YYY" type="text" disabled/>
		</div>
		<div class="form-group col-lg-12">
	      	<label for="inputEmail4">Category</label>
	      	<select name="category_id" id="inputState" class="form-control" disabled>
		        <option value="1">Important</option>
		        <option value="2">Public</option>
		        <option value="3">Teachehrs</option>
	      	</select>
	    </div>
	    <div class="form-group col-lg-12">
			<input type="submit" name="deleteSubmit" value="Delete" class="btn btn-submit">
		</div>
	</fieldset>
</form>
<a href="/articles/index">Go Back</a>

</main>
