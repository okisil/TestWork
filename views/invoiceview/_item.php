<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<tr data-key="<?= $item['id'] ?>">
	<td><?= $item['id'] ?></td>
	<td><?= $item['name_product'] ?></td>
	<td><?= $item['weight'] ?></td>
	<td><?= $item['cost'] ?></td>
	<td><?= $item['total'] ?></td>
	<td>
		<?=	$panel->writeAction($item['id']); ?>​			
	</td>
</tr>