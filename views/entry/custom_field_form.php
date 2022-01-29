<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<div class="custom-create">

    <?php Pjax::begin() ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entry_id')->hiddenInput(['value' => $entry_id])->label(false); ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]);  ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <?php Pjax::end() ?>
</div>