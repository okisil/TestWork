<?php

use yii\helpers\Html;

$this->title = 'Update Product Record';

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
        'model' => $model, 
    ]) ?>