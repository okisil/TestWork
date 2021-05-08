<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerJsFile(
    '@web/js/eventAdd.js');

?>
<div class="row">
	<div class="col-md-12 head-table">
		<h1 class="main-head">List of Product</h1>
		<div class="add">
		<?=	$panel->writeAdd() ?>
		</div>​
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="my-component-table" id="tableProduct">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th class="col-action">Action</th>
					</tr>
				</thead>
				<tbody>
				  <?php foreach ($models as $value ) : ?>
					 <?= $this->render('_item', ['model' => $value, 'panel' => $panel]) ?> 
				  <?php endforeach; ?>
				 </tbody> 
			</table>
			<div class="center-linker">
				<?= LinkPager::widget(['pagination' => $pages]); ?>
			</div>						
		</div>
	</div>
</div>

