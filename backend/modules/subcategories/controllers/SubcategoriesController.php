<?php

namespace backend\modules\subcategories\controllers;

use backend\models\Categories;
use backend\models\RelationsCategory;
use Yii;
use backend\models\Subcategories;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubcategoriesController implements the CRUD actions for Subcategories model.
 */
class SubcategoriesController extends Controller
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
						'roles' => ['administrator', 'moderator'],
					]
				]
			]
		];
	}

	/**
	 * Lists all Subcategories models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Subcategories::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Subcategories model.
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
	 * Creates a new Subcategories model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Subcategories();

		if ($model->load(Yii::$app->request->post())) {
			$nameSubCategory = Yii::$app->request->post('Subcategories')['name'];
			$issetSubCategory = $model->getSubCategoryByName($nameSubCategory);
			if (empty($issetSubCategory) AND $model->save()) {
				$selectedCategory = Yii::$app->request->post('Subcategories')['category'];
				if (!empty($selectedCategory)) {
					$relationsCategory = new RelationsCategory();
					$relationsCategory->subcategory = $model->getPrimaryKey();
					$relationsCategory->category = $selectedCategory;
					$relationsCategory->save();
				}
				Yii::$app->getSession()->setFlash('success', 'Подкатегория ' . $nameSubCategory . ' была успешно создана');
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				Yii::$app->getSession()->setFlash('error', 'Подкатегория с таким иминем уже существует');
				return $this->redirect(['/subcategories/subcategories', 'id' => $model->id]);
			}
		}

		$modelCategories = new Categories();
		$dropDownCategories = $modelCategories->getArrayDropDownCategories();

		return $this->render('create', [
			'model' => $model,
			'dropDownCategories' => $dropDownCategories,
		]);
	}

	/**
	 * Updates an existing Subcategories model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post())) {
			$nameSubCategory = Yii::$app->request->post('Subcategories')['name'];
			$issetSubCategory = $model->getSubCategoryByName($nameSubCategory);
			if (empty($issetSubCategory)) {
				if ($model->save()) {
					Yii::$app->getSession()->setFlash('success', 'Вы успешно переименовали подкатегорию.');
					return $this->redirect(['view', 'id' => $model->id]);
				}
			} else {
				Yii::$app->getSession()->setFlash('error', 'Подкатегория с таким иминем уже существует.');
			}
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Subcategories model.
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
	 * Finds the Subcategories model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Subcategories the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Subcategories::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
