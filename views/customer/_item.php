<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<tr data-key="<?= $model['id'] ?>">
	<td><?= $model['id'] ?></td>
	<td><?= $model['name'] ?></td>
	<td><?= $model['status'] ?></td>
	<td><?= $model['address'] ?></td>
	<td>
		<?= $panel->writeAction($model['id']); ?>​			
	</td>
</tr>