<?php

namespace backend\modules\user\controllers;

use backend\models\CreateUser;
use Yii;
use common\models\user;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
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
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'view', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['administrator'],
					]
				]
			]
		];
	}

	/**
	 * Lists all user models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => user::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single user model.
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
	 * Creates a new user model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new CreateUser();
		$userModel = new User();
		$roles = $userModel->getRolesDropDown();

		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			Yii::$app->getSession()->setFlash('success', 'Пользователь был успешно создан.');
			return $this->redirect(['/user/user']);
		}

		return $this->render('create', [
			'roles' => $roles,
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing user model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if (!empty(Yii::$app->request->post())) {
			$postData = Yii::$app->request->post('User');
			$model->username = $postData['username'];
			$model->role = $postData['role'];
			$model->save();

			return $this->redirect(['view', 'id' => $model->id]);
		}

		$roles = $model->getRolesDropDown();

		return $this->render('update', [
			'roles' => $roles,
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing user model.
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
	 * Finds the user model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return user the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = user::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
