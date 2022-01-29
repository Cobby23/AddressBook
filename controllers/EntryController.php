<?php

namespace app\controllers;

use app\models\Entry;
use app\models\EntrySearch;
use app\models\EntryToLabel;
use app\models\CustomFields;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;

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
        $dataProvider = new ActiveDataProvider([
            'query' => EntryToLabel::find()->where(['entry_id' => $id]),
        ]);

        $customDataProvider = new ActiveDataProvider([
            'query' => CustomFields::getFieldsByEntryQuery($id),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'customDataProvider' => $customDataProvider
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

    public function actionRemoveLabel($etl_id){
        $model = EntryToLabel::findOne($etl_id);
        $entry_id = $model->entry_id;

        $model->delete();

        return $this->redirect(['view', 'id' => $entry_id]);
    }

    public function acrionAddCustomField($id){
        $model = new CustomFields();

        return $this->renderAjax('custom_field_form', [
                 'model' => $model,
         ]);

        // if(!($model->load($this->request->post()) && $model->save())){
        //     return $this->render('custom_field_form',[
        //         'model' => $model,
        //         'entry_id' => $id,
        //     ]);
        // }
    }

    protected function findModel($id)
    {
        if (($model = Entry::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
