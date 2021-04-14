<?php

namespace backend\controllers;

use backend\models\CourseDollar;
use backend\models\Products;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$courseModel = new CourseDollar();

		if (Yii::$app->request->post()) {
			$newCourse = Yii::$app->request->post('CourseDollar')['course'];
			$courseDollar = $courseModel::find()->one();

			if (!is_null($courseDollar)) {
				$courseDollar->course = $newCourse;
				$courseDollar->update();
			} else {
				$courseModel->load(Yii::$app->request->post());
				$courseModel->save();
			}

			$productModel = new Products();
			$products = $productModel::find()->where(['not', ['dollar_price' => null]])->all();

			foreach ($products as $product) {
				$price = $newCourse * $product->dollar_price;
				$product->price = $price;
				$product->update(false);
			}

			Yii::$app->getSession()->setFlash('success', 'Курс был успешно изменен. Изминения цены в продуктах произошлы успешно.');
		}

		$course = $courseModel->getCourse();

		return $this->render('index', [
			'courseModel' => $courseModel,
			'course' => $course
		]);
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$this->layout = 'blank';

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->adminLogin()) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}
}
