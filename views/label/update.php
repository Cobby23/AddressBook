<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Label */

$this->title = 'Update Label: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="label-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
