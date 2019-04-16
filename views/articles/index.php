<main class="<?=(isset($_SESSION['loggedInUserRole']))?"":"container-fluid"; ?>">
<script type="text/javascript" src="<?=BASE_PATH?>views/public/scripts/articlesindex.js"></script>	
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/articles/index.css">
<div>
	<div class="col-md-12">	
		<h2 class="">Newsfeed</h2>
<?php if($this->msgBool) { ?>
		<div class="col-xs-12">
			
			<span class="<?=$this->msgColor; ?>"><?= $this->msg ?></span>
		</div>
<?php } ?>

<?php if (isset($_SESSION['loggedInUserRole'])&&$_SESSION['loggedInUserRole']=='admin') { ?>
		<a href="<?=BASE_PATH?>articles/add" class="btn">Add Article</a>
<?php } ?>

	</div>
	<div class="col-md-6 col-sm-9 col-xs-12">
		<div class="col-xs-12">
			<label>Search</label>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-10">
				<input type="text" id="search" placeholder="Search..." class="form-control">
			</div>
			<div class="col-xs-2">
				<button class="btn btn-default" onclick="search()">Search</button>
			</div>
		</div>	
	</div>
</div>
<div id="articleList">
	<?php require_once 'articleList.php'; ?>
</div>
</main>