<?php

namespace app\controllers;

use app\models\Entry;
use app\models\EntrySearch;
use app\models\EntryToLabel;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * EntryController implements the CRUD actions for Entry model.
 */
class EntryController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new EntrySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Entry();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    public function actionAddNote($id){
        return $this->redirect(['note/create', 'entry_id' => $id]);
    }

    public function actionViewNotes($id){
        return $this->redirect(['note/index', 'entry_id' => $id]);
    }

    public function actionAddLabel($id){
        $model = new EntryToLabel();
        $model->entry_id = $id;

        if($model->load($this->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $id]);
        }
        else{
            return $this->render('label_form', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Entry::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
