<?php

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

?>

<tr data-key="<?= $Model['id'] ?>">

	<td><?= $Model['id'] ?></td>
	<td><?= $Model['customer_name'] ?></td>
	<td ><?= $Model['total_weight'] ?></td>
	<td><?= $Model['sum'] ?></td>
	<td>
		<?=	$panel->writeAction($Model['id']); ?>​

		<?=	Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
			Url::to(['/invoiceview/invoice-view/invoice-full', 'id' => $Model['id']]) 
			
			) ?>​				
	</td>

</tr>