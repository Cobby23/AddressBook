<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Note */

$this->title = 'Update Note: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="note-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'entry_id' => $entry_id,
    ]) ?>

</div>
