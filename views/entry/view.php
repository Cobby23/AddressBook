<?php

use app\models\Label;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Entry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entry-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add Field', ['custom-fields/create', 'entry_id' => $model->id], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'user_id',
                'value' => Yii::$app->user->username,
                'label' => "User"
            ],
            'first_name',
            'last_name',
            'company',
            'address',
            'phone_number',
            'email:email',
            'fax',
            'mobile_number',
            'note',
        ],
    ]) ?>

    <h3>Custom fields</h3>
    <?= GridView::widget([
        'dataProvider' => $customDataProvider,
        'layout' => '{items}',
        'columns' => [
            [
                'label' => 'Field name',
                'value' => 'label',
            ],
            [
                'label' => 'Content',
                'value' => 'content',
            ],
            [
                'label' => '',
                'format' => 'html',
                'value' => function($model){
                    return Html::a('Remove Field', Url::to(Url::base().'/custom-fields/delete?id='.$model->id), ['class' => 'text-danger']);
                }
            ]
                
        ] 
    ]) 
    ?>

    <h3>Tags</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'columns' => [
            [
                'label' => 'Tag',
                'value' => 'label.title',
            ],
            [
                'label' => 'Color',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('<i class="fas fa-tint"></i>', Url::to(Url::base().'/label/'.$model->label->id), [
                        'style' => ['color' => $model->label->color],
                        'title' => $model->label->title,
                    ]);
                   
                }
            ],
            [
                'label' => '',
                'format' => 'html',
                'value' => function($model){
                    return Html::a('Remove Tag', Url::to(Url::base().'/entry/remove-label?etl_id='.$model->id), ['class' => 'text-danger']);
                }
            ]
                
        ] 
    ]) 
    ?>

</div>
