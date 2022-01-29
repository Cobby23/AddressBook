<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Entry;

/* @var $this yii\web\View */
/* @var $model app\models\Note */

$this->title = $model->id;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="note-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'entry_id',
                'label' => 'Entry',
                'value' => Entry::findOne($model->entry_id)->first_name,
            ],
            'note:html',
        ],
    ]) ?>

</div>
