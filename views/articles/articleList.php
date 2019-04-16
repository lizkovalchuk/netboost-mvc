
<?php foreach ($this->articles as $article) { 
	?> 
			<article class="col-sm-12">
			<div class="row">
				<div class="col-sm-3">
					<img style="width:100%" 
					src="<?=BASE_PATH?>
					<?=($article->image_url!=null&& $article->image_url!="")?"uploads/articles/$article->image_url":"views/public/images/image.png"?>"/>
				</div>
				<div class="col-sm-9">
					<h3 style="margin-top:0"><?=$article->title?></h3>
					<p><?=$article->body?></p>
					<p><?=$article->name?></p>
<?php  if(isset($_SESSION['loggedInUserRole'])&&$_SESSION['loggedInUserRole']=='admin'){?>
					<a href="<?=BASE_PATH?>articles/edit/<?=$article->id?>">Edit</a>|<a href="<?=BASE_PATH?>articles/delete/<?=$article->id?>">Delete</a>
<?php }?>

				</div>
			</div>
			</article>
		<?php  }?>