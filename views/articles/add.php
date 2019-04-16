<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/form.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/index.css">
<main>
<?php 
$hour = 0;
$minute = 0;
$date = "";
?>
<h2>Add Article</h2>
<?php 
	if($this->msgBool) { 
?>
		<div class="col-xs-12">
			
			<span class="<?=$this->msgColor; ?>"><?= $this->msg ?></span>
		</div>
<?php
 	} 
?>
<a href="/articles/index">Go Back</a>

<form method="POST" enctype="multipart/form-data" action="<?=BASE_PATH?>articles/addPost">

	<fieldset class="col-lg-8 col-md-10 col-xs-12">
		<legend>New Article</legend>
		<div class="form-group col-lg-12">
			<label for="txt_title">Title</label>
			<input class="form-control" id="title" value="<?=$this->article->title?>" type="text" name="title" placeholder="Enter title...">
		</div>
		<div class="form-group col-lg-12">
			<label for="txt_body">Body</label>
			<textarea value="<?=$this->article->body?>" class="form-control" rows="5" id="body" type="text" name="body"></textarea>
		</div>
		<div class="form-group col-lg-12">
		    <label for="image_url">Image</label>
		    <input value="<?=$this->article->image_url?>" type="file" class="form-control-file" id="image_url" name="image_url">
		</div>
		<div class="form-group col-lg-12">
			<label class="control-label" for="date">Publish Date</label>
			<div class="row">
				<div class="col-xs-6">
					<input value="<?=isset($this->article->publish_date)?explode(' ',$this->article->publish_date)[0]:""?>" class="form-control" id="date" name="publish_date" placeholder="MM/DD/YYYY" type="date"/>
				</div>
				<div class="col-xs-3">
					<select name="hour" class="form-control">
						<?php for ($i=0; $i < 12; $i++) {?> 
						<option value="<?=$i?>"<?=$i==$hour?' selected':''?>><?=$i?></option>
						<?php }?>
					</select>
				</div>
				<div class="col-xs-3">
					<select name="hour" class="form-control">
						<?php for ($i=0; $i < 4; $i=$i+15) {?> 
						<option value="<?=$i?>"<?=$i==$minute?' selected':''?>><?=$i?></option>
						<?php }?>
					</select>
				</div>
			</div>

		</div>
		<div class="form-group col-lg-12">
	      	<label for="inputEmail4">Category</label>
	      	<select name="category_id" id="inputState" class="form-control">
		        <?php foreach ($this->categories as $category) {?>
	      		<option value="<?=$category->id?>"><?=$category->name?></option>	
  			<?php }?>
	      	</select>
	    </div>
	    <div class="form-group col-lg-12">
			<input class="btn btn-submit" type="submit" name="addSubmit">
		</div>
	</fieldset>
</form>
</main>
