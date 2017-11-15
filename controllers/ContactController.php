<?php

namespace app\controllers;

use Yii;
use app\models\ContactPerson;
use app\models\ContactPersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Company;
use app\models\Address;
use yii\helpers\ArrayHelper;

/**
 * ContactController implements the CRUD actions for ContactPerson model.
 */
class ContactController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ContactPerson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContactPerson model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      $address = Address::findOne($model->address_id);
      $company = Company::findOne($model->company_id);
        return $this->render('view', [
            'model' => $model,
            'address' => $address,
            'company' => $company
        ]);
    }

    /**
     * Creates a new ContactPerson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContactPerson();
        $company = ArrayHelper::map(Company::find()->all(), 'id', 'name');
        $address = ArrayHelper::map(Address::find()->all(), 'id', 'city' ,
        'country' , 'state' , 'zip' ,'phone' );

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'company' => $company,
                'address' => $address,
            ]);
        }
    }

    /**
     * Updates an existing ContactPerson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $company = ArrayHelper::map(Company::find()->all(), 'id', 'name');
        //$address = ArrayHelper::map(Address::find()->all(), 'id', 'city');
        $address = ArrayHelper::map(Address::find()->select(['id', "CONCAT(street, ' ' ,city, ' ', state , ' ', 'country', ' ', 'phone') AS addr"] )->asArray()->all(), 'id', 'addr');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'company' => $company,
                'address' => $address,
            ]);
        }
    }

    /**
     * Deletes an existing ContactPerson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(!$model->is_default)
        {
          $model->delete();
        }
        else{
          Yii::$app->session->setFlash('contactDefaultAddress');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContactPerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ContactPerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContactPerson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
