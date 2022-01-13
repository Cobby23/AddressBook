<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Entry;
use app\models\EntryToLabel;
use app\models\Label;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entry-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Entry', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'first_name',
            'last_name',
            //'company',
            //'address',
            //'phone_number',
            'email:email',
            //'fax',
            //'mobile_number',
            //'note',
            [
                'label' => '',
                'format' => 'html',
                'value' => function($model){
                    return Html::a('See more', Url::toRoute(['view', 'id' => $model->id]));
                }
            ],
            [
                'label' => 'tags',
                'format' => 'html',
                'value' => 
                    function($model){
                        $labels = $model->getLabels();
                        $return = '';

                        foreach($labels as $label){
                            $return = $return.Html::a('<i class="fas fa-tag"></i>', Url::to(Url::base().'/label/'.$label->id), [
                                'style' => 'color:'.$label->color.';',
                                'title' => $label->title,
                            ]);
                        }
                        return $return;
                    }
                
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function($url){
                        return Html::a('<i class="far fa-trash-alt"></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'update' => function ($url) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                        ]);       
                    },
                    'add-note' => function ($url) {
                        return Html::a('<i class="far fa-sticky-note"></i>', $url, [
                            'title' => Yii::t('yii', 'Add note'),
                        ]);       
                    },
                    'view-notes' => function ($url) {
                        return Html::a('<i class="far fa-clipboard"></i>', $url, [
                            'title' => Yii::t('yii', 'View notes'),
                        ]);       
                    },
                    'add-label' => function ($url) {
                        return Html::a('<i class="fas fa-tags"></i>', $url, [
                            'title' => Yii::t('yii', 'Add Tag'),
                        ]);
                    }
                ],
                'template' => "{update} {delete} {add-note} {view-notes} {add-label}"
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
