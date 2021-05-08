<?php

use yii\helpers\Html;

$this->title = 'Update Customer Record: id' . ' ' . $model['id'];

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
        'model' => $model,
    ]) ?>