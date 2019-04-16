<!-- ######################## -->
<!-- MAIN SECTION CONTENT!!!! -->
<!-- ######################## -->
<link rel="stylesheet" type="text/css" href="views/public/css/ratings/index.css"> 
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/form.css">
<main class="">
<?php if (count($this->projects)>0) {?>
	
<h2 style="margin-bottom: 20px;">Evaluate your experience with the company.</h2>

<div class="col-xs-12">
	<div class="col-md-3 center-content">
		<h3 style="margin-top: 0"></h3>
	</div>
	<div class="col-md-9 row">
		<div class="col-xs-2 col-md-offset-1 center-content">
			<label>Unsatisfactory</label>
		</div>
		<div class="col-xs-2 col-xs-offset-6 center-content">
			<label>Satisfactory</label>
		</div>
	</div>
</div>
<!-- FORM STARTS HERE -->
<form method="POST" action="<?=BASE_PATH?>ratings/rateProjects">
	<div class="col-xs-12">
	<fieldset>
		<legend>Ratting items</legend>
		<input type="hidden" name="count" value="<?=count($this->projects)?>">
		<div class="col-xs-12">
			<select name="project_id">
				<?php foreach($this->projects as $option){ ?>
					<option  value="<?=$option->id?>"><?=$option->name?></option>
				<?php }?>
			</select>
		</div>
	<?php foreach ($this->ratings as $rating) {?>
		<div class="form-group col-xs-12">
			<div class="col-md-3 col-xs-10 center-content">
				<label><?=$rating->name;?>:</label>
			</div>
			<div class="col-md-9">
					<div class="form-row" style="text-align: center">
		<?php for ($i=1; $i <= 5 ; $i++) { ?>
						<div class="col-xs-2<?=($i==1)?' col-md-offset-1':'';?>">
					    	<input value="<?=$i?>" type="radio" name="<?=$rating->id?>-radio">
						</div>
		<?php }?>
					</div>
			</div>
		</div>
	<?php }?>

		<div class="col-xs-10 col-md-offset-1 center-content">
			<input class="btn c-btn" type="submit" name="sendRatings">
		</div>
	</fieldset>
	</div>
</form>
<?php } else{?>
<h2>Sorry, you don't have companies to rate.</h2>
<?php } ?>
</main>