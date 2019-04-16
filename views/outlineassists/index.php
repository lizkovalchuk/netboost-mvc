
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/outlineassists/index.css">
<script type="text/javascript" src="<?=BASE_PATH?>views/public/scripts/outlineassists/index.js"></script>
<main>
<div class="col-xs-12">
	<h2>Edit students in your class.</h2>
	<div class="col-xs-12 col-sm-9 col-md-6">
	<input type="hidden" id="outlineId" value="<?=$this->outlineId?>">
		<select class="js-example-basic-single" id="addStudent">
		<?php foreach ($this->students as $student) {?>
			<option value="<?=$student->id?>"><?=$student->first_name.' '.$student->last_name?></option>
		<?php } ?>
		</select>
		<button class="btn btn-default" onclick="addStudent(event)">Add</button>
	</div>
	<div class="col-xs-12 col-sm-9">
		<table id="table">
			
<?php require_once 'student_list.php' ?>

		</table>
		<a class="c-btn" href="<?=BASE_PATH?>outlines/details/<?=$this->outlineId?>">Back to outline</a>
	</div>
</div>
</main>
<script type="text/javascript">
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>














	<!-- <div class="row">
			<div class="col-xs-10">
				<input type="text" id="search" name="search" class="form-control">
			</div>
			<div class="col-xs-2">
				<button class="btn btn-default">Search</button>
			</div>
		</div> -->
