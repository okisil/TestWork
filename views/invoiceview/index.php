<?php

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

$this->registerJsFile(
    '@web/js/eventAdd.js');
?>

<div class="row">
	<div class="col-md-12 head-table">
		<div class="main-head">
			<h5>Id: <?= $model['head']['id'] ?></h1>
			<h5>Name customer: <?= $model['head']['customer_name'] ?></h1>
			<h5>Date: <?= $model['head']['date'] ?></h1>
			<h5>Sum: <?= $model['head']['sum'] ?></h1>
			<h5 class="weight">Weight: <?= $model['head']['total_weight'] ?></h1>
		</div>
		<div class="add">
			<?= Html::a('Back to Invoice', Url::previous() , ['class' => 'btn btn-primary']); ?>
			<?=	$panel->writeAdd(); ?>​
		</div> 
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="my-component-table" id="tableListItems">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
						<th>Weight</th>
						<th>Cost</th>
						<th>Total</th>
						<th class="col-action">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($model['items'] as $item ) : ?>
						<?= $this->render('_item', ['item' => $item, 'panel' => $panel ])	?>  
					<?php endforeach; ?>
				 </tbody>   
				</tbody> 
			</table>
		</div>
	</div>
</div>