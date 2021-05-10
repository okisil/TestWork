<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;

?>
<div class="row">
	<div class="col-md-2">
		<?= $this->render('_formBetweenDate', ['dateForm' => $dateForm]) ?>
	</div>
	<div class="col-md-10">
		<h1 class="main-head invoice-param">List of Invoice</h1>
		<?php if (isset($models) && isset($pages)): ?>
			<div class="row">
				<?php foreach ($models as $model ) : ?>
				<div align="center">
					<?= $model->format_date ?>
				</div> 
					
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
								<?php  foreach ($model->storage as $item ) : ?>
									<?= $this->render('_item', ['Model' => $item, 'panel' => $panel ])	?> 
								<?php endforeach; ?>
							</tbody>
						</table>
						 
				<?php endforeach; ?>
				<div class="center-linker">
	                <?= LinkPager::widget(['pagination' => $pages]); ?>
	            </div>					
			</div>
		<?php endif; ?>
	</div>	
</div>