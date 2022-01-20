<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Label;

$this->title = 'Create Entry';
$this->params['breadcrumbs'][] = ['label' => 'Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="entry-form">

    <?php if(Yii::$app->request->get('errors')){
                echo Html::tag('p', Yii::$app->request->get('errors'), ['class'=>'alert alert-danger']);
            }
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'label_id')->dropDownList(Label::getLabelDropdown(), [
                    'prompt' => ['text' => Yii::t('app', 'Select...'),
                    'options' => ['disabled' => true]]
                    ])
                ->label(Yii::t('app', 'Label')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>