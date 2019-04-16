<!-- ######################## -->
<!-- MAIN SECTION CONTENT!!!! -->
<!-- ######################## -->
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/form.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/picks/index.css"> 
<main class="">
	<?php if (count($this->picks)>0) {?>
<h2 style="margin-bottom: 20px;">Rate your prefered projects.</h2>

<!-- FORM STARTS HERE -->
<form method="POST" action="<?=BASE_PATH?>picks/submitPicks">
	
	<div class="col-xs-12">
		<fieldset>		
			<legend>Projects</legend>
			<div class="col-sm-3 center-content">
				<h3 style="margin-top: 0"></h3>
			</div>
			<div class="col-sm-9 row">
				<div class="col-sm-2 col-sm-offset-1 center-content">
					<label>Least prefered</label>
				</div>
				<div class="col-sm-2 col-sm-offset-6 center-content">
					<label>Most prefered</label>
				</div>
			</div>	
			<input type="hidden" name="count" value="<?=count($this->picks)?>">
		<?php foreach ($this->picks as $pick) {?>
				<div class="form-group col-sm-12">
				<div class="col-sm-3 center-content">
					<label><?=$pick->name;?></label>
				</div>
				<div class="col-sm-9">
						<div class="form-row" style="text-align: center">
			<?php for ($i=1; $i <= 5; $i++) {?> 
							<div class="col-sm-2<?=($i==1)?' col-md-offset-1':''?>">
						    	<input type="radio" value="<?=$i?>" name="<?=$pick->id?>-radio">
							</div>
			<?php }?>
						</div>
				</div>
			</div>
		<?php } ?>
			<div class="col-sm-12">
				<input class="btn c-btn" type="submit" name="sendPicks">
			</div>
		</fieldset>
	</div>
</form>
<?php } else{?>
<h2>Sorry, you don't have projects to pick yet.</h2>
<?php } ?>
</main>