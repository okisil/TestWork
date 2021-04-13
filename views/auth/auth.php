<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin([]); ?>

	<?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

