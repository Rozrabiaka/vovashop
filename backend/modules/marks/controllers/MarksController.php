<?php

namespace backend\modules\marks\controllers;

use Yii;
use backend\models\Marks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarksController implements the CRUD actions for Marks model.
 */
class MarksController extends Controller
{
	/**
	 * {@inheritdoc}
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
	 * Lists all Marks models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Marks::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Marks model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Marks model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Marks();

		if (!empty(Yii::$app->request->post())) {
			if (is_null($model->issetMarkNyName(Yii::$app->request->post('Marks')['name']))) {
				if ($model->load(Yii::$app->request->post()) && $model->save()) {
					return $this->redirect(['view', 'id' => $model->id]);
				} else {
					Yii::$app->getSession()->setFlash('error', 'Ошибка при создание марки. Пожалуйста, попробуйте сново.');
				}
			} else {
				Yii::$app->getSession()->setFlash('error', 'Марка с таким именем уже существует.');
			}
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Marks model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		if (!empty(Yii::$app->request->post())) {
			if (is_null($model->issetMarkNyName(Yii::$app->request->post('Marks')['name']))) {
				if ($model->load(Yii::$app->request->post()) && $model->save()) {
					return $this->redirect(['view', 'id' => $model->id]);
				}
			} else {
				Yii::$app->getSession()->setFlash('error', 'Марка с таким именем уже существует.');
			}
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Marks model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Marks model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Marks the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Marks::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
