<?php

use yii\jui\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html

?>

<div class="form-date">
	<?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get', 'layout' => 'inline']); ?>
	  
	    <?= $form->field($dateForm, 'date')->widget(DatePicker::className(), 
	    	['language' => 'ru', 'dateFormat' => 'dd-MM-yyyy',]
	    ) ?>	

	    
	    <div class="form-group">
	        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>