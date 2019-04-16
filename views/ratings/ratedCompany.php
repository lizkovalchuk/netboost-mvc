<?php 
		$currentId=0;
		$changing = false;
		for($i = 0; $i < count($this->companies);$i++){ 
			$company = $this->companies[$i];
			if($currentId!=$company->id){
				$currentId = $company->id;
	?>
			<div class="company">
				<a data-toggle="collapse" href="#collapse<?=$name = str_replace(' ', '_',$company->name)?>" role="button" aria-expanded="false" aria-controls="collapseExample">
				<div class="generalInfo">
					<div class="row">
						<div class="col-xs-5">
							<label class="pull-right">Name:</label>
						</div>
						<div class="col-xs-7">
							<span><?=$company->name?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-5">
							<label class="pull-right">Rating:</label>
						</div>
						<div class="col-xs-7">
							<span><?=number_format(floatval($company->totalAverage),1)?></span>
						</div>
					</div>
				</div>
				</a>	
				<div class="collapse" id="collapse<?=$name = str_replace(' ', '_',$company->name)?>">
			<?php }?>
					<!-- foreach -->
					<div class="row">
						<div class="col-xs-5">
							<label class="pull-right"><?=$company->rname?>:</label>
						</div>
						<div class="col-xs-7">
							<span><?=number_format(floatval($company->average),1)?></span>
						</div>
					</div>
					<!-- end foreach -->
			<?php if(($i+1)==count($this->companies)||$this->companies[$i+1]->id!=$company->id){?>	
				</div>
			</div>
	<?php 		
					$changing= false;
				}
			}?>