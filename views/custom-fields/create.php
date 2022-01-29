<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CustomFields */

$this->title = 'Create Custom Fields';
$this->params['breadcrumbs'][] = ['label' => 'Custom Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'entry_id' => $entry_id,
    ]) ?>

</div>
