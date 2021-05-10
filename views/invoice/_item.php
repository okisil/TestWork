<?php

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

?>


<tr data-key="<?= $Model['id'] ?>">

	<td><?= $Model['id'] ?></td>
	<td><?= Yii::$app->formatter->asDate($Model['date'], 'php:d F Y') ?></td>
	<td><?= $Model['id_customer']['name'] ?></td>
	<td><?= $Model['total_weight'] ?></td>
	<td><?= $Model['sum'] ?></td>
	<td>
		<?=	Html::a('<span class="glyphicon glyphicon-trash"></span>',
			Url::to(['/invoice/invoice/invoice-delete']), 
			['data' => 
				['method' => 'POST', 
			 	'params' => ['id' => $Model['id'] ]
				]
			]) ?>​

		<?=	Html::a('<span class="glyphicon glyphicon-pencil"></span>',
			Url::to(['/invoice/invoice/invoice-update', 'id' => $Model['id']]) 
			
			) ?>​
		<?=	Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
			Url::to(['/invoiceview/invoice-view/invoice-full', 'id' => $Model['id']]) 
			
			) ?>​				
	</td>

</tr>