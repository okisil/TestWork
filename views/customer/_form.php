<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(['id' => 'customer-form']); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?> 

    <?= $form->field($model, 'address')->textInput() ?>  

	<?= $form->field($model, 'status', [])->inline()->radioList([1 => 'Yes', 0 => 'No']); ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>