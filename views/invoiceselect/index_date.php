<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;

$this->registerJsFile(
    '@web/js/eventAdd.js');
?>

<div class="row">
	<div class="col-md-12">
		<?= $this->render('_formDate', ['dateForm' => $dateForm])	?>
	</div>
</div>
<div class="row">
	<div class="col-md-12 head-table">
		<h1 class="main-head">List of Invoice</h1>
		<div class="add">
            <?= $panel->writeAdd(); ?>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="my-component-table" id="tableInvoice">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>id</th>
						<th>id_customer</th>
						<th>Total weight</th>
						<th>Sum</th>
						<th class="col-action">Action</th>
					</tr>
				</thead>
				<tbody>
				  <?php foreach ($models as $model ) : ?>
					<?= $this->render('_item', ['Model' => $model, 'panel' => $panel ])	?>  
				  <?php endforeach; ?>
				 </tbody> 
			</table>
			
		</div>
	</div>
</div>