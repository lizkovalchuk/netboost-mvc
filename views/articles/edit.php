<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/form.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/index.css">
<main>
<?php
$date = "";
$hour = "";
$minute = "";
if(isset($this->article->publish_date)){
	$splitDate = explode(' ',$this->article->publish_date);
	$date = $splitDate[0];
	$time = explode(':',$splitDate[1]);
	$hour = $time[0];
	$minute = $time[1];
}

?>

<h2>Edit Article</h2>
<!-- THIS IS BASICALLY A NORMAL HTML
THE ONLY DIFFERENCE ARE IN THE VALUES AND INSERTED PHP in the inputs
and options -->
<?php 
	if($this->msgBool) { 
?>
		<div class="col-xs-12">
			
			<span class="<?=$this->msgColor; ?>"><?= $this->msg ?></span>
		</div>
<?php
 	} 
?>
<div><a href="/articles/index">Go Back</a></div>

<form method="POST" enctype="multipart/form-data" action="<?=BASE_PATH?>articles/editPost">
	<fieldset class="col-lg-8 col-md-10 col-xs-12">
		<legend><?=$this->article->title?></legend>
		<input type="hidden" name="previousImage" value="<?=$this->article->image_url?>">
		<input type="hidden" name="id" value="<?=$this->article->id?>">
		<div class="form-group col-lg-12">
			<label for="txt_title">Title</label>
			<input class="form-control" id="title" value="<?=$this->article->title?>" type="text" name="title" placeholder="Enter title...">
		</div>
		<div class="form-group col-lg-12">
			<label for="txt_body">Body</label>
			<textarea class="form-control" rows="5" id="body" type="text" name="body"><?=$this->article->body?></textarea>
		</div>
		<div class="form-group col-lg-12">
		    <label for="image_url">Image</label>
		    <input type="file" class="form-control-file" name="image_url"><a href="<?=BASE_PATH?>articles/eraseImage/<?=$this->article->id?>">Erase Image</a>
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
			<input class="btn btn-submit" type="submit" name="editSubmit">
		</div>
	</fieldset>
</form>

</main>
