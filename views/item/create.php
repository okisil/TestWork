<?php

use yii\helpers\Html;

$this->title = 'Create Product Record';

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
        'model' => $model, 
    ]) ?>