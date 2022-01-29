<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;

/* @var $this yii\web\View */
/* @var $model app\models\Note */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entry_id')->hiddenInput(['value' => $entry_id])->label(false) ?>

    <?= $form->field($model, 'note')->widget(Summernote::class, [
    'useKrajeePresets' => true,
    'value' => 'Write your note here...',
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
