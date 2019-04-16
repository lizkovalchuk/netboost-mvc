<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/ratings/ratedCompanies.css">
<main>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2>Our top companies</h2>
				<p>Rated by our students.</p>
			</div>
		</div>
		<div id="companiesList" class="row col-xs-12">
	<?php require_once 'ratedCompany.php' ?>
		
		</div>
	</div>
</main>