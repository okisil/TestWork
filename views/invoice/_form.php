<?php

use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


?>

<?php $form = ActiveForm::begin(); ?>

	<?php $items = ArrayHelper::map($model->getAllCustomers() ,'id','name');	

	?>

    <?= $form->field($model, 'id_customer', ['inputOptions' => ['autofocus' => 'autofocus']])->dropDownList($items) ?>


    <?= $form->field($model, 'date')->widget(DatePicker::className(), ['language' => 'ru', 'dateFormat' => 'dd-MM-yyyy',
  ]) ?>	

    
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php 
	
ActiveForm::end(); ?>