<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/*use yii\helpers\VarDumper;*/

$this->registerJsFile(
    '@web/js/tabItem.js');

?>

<?php $form = ActiveForm::begin(); ?>

	<?php $items = ArrayHelper::map($model->getAllProducts() ,'id','name');	?>

	<?= $form->field($model, 'id_product', ['inputOptions' => ['autofocus' => 'autofocus']])->dropDownList($items) ?>
	
	<?= $form->field($model, 'id_invoice')->hiddenInput()->label(false) ?>

	<?= $form->field($model, 'weight')->textInput() ?>
	
    <?= $form->field($model, 'cost')->textInput() ?>
 
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>