<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Note */

$this->title = 'Create Note';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'entry_id' => $entry_id,
    ]) ?>

</div>
