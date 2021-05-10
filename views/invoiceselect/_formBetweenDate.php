<?php

use yii\jui\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>

<div class="form-date">
	<?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get', 
		'fieldConfig' => [
        'template' => '{label}<div class="col-sm-11">{input}</div><div class="col-md-11">{error}</div>',
        'labelOptions' => ['class' => 'col-md-1 control-label'],
    	],
		 'options' => ['class' => 'form-horizontal'], ]); ?>

		<?php $items = ArrayHelper::map($dateForm->getAllCustomers() ,'id','name'); 
		?> 

	  
	    <?= $form->field($dateForm, 'dateAfter')->widget(DatePicker::className(), 
	    	['language' => 'ru', 'dateFormat' => 'dd-MM-yyyy',]
	    ) ?>

	    <?= $form->field($dateForm, 'dateBefore')->widget(DatePicker::className(), 
	    	['language' => 'ru', 'dateFormat' => 'dd-MM-yyyy',]
	    ) ?>

		<?= $form->field($dateForm, 'id')->checkboxList(
            $items, ['separator' => '<div></div>', 'item' =>

                function ($index, $label, $name, $checked, $value) {

                    return Html::checkbox($name, $checked, [

                        'value' => $value,

                        'label' => '<span>' . $label . '</span>',

                 		'labelOptions' => ['class' => "customer-class col-md-12 col-sm-6 col-xs-6"],       

                         

                    ]);

                } ]
    		)->label('Name of Customers', ['class' => 'customer-head']);

    	?>
	    	

	    
	    <div class="form-group">
	    	<div>
	    		<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
	    	</div>
	    </div>

	<?php ActiveForm::end(); ?>



</div>