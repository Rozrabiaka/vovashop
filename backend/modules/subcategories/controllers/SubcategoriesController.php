<?php

namespace backend\modules\subcategories\controllers;

use backend\models\Categories;
use backend\models\RelationsCategory;
use Yii;
use backend\models\Subcategories;
use yii\data\ActiveDataProvider;
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

		$message = '';
		$errorMessage = '';
		if ($model->load(Yii::$app->request->post())) {
			$issetSubCategory = $model->getSubCategoryByName(Yii::$app->request->post('Subcategories')['name']);
			$resultSave = false;
			$issetRelation = false;

			if (empty($issetSubCategory)) {
				$resultSave = $model->save();
				if ($resultSave === true) $message .= 'Созданная подкатегория была успешно сохранена.';
			} else {
				$errorMessage .= 'Подкатегория с таким иминем уже существует.';
			}

			$selectedCategory = Yii::$app->request->post('Subcategories')['category'];
			if (!empty($selectedCategory)) {
				$selectedSubCategory = Yii::$app->request->post('Subcategories')['issetSubCategory'];
				$relationsCategory = new RelationsCategory();

				if (!empty($selectedCategory) AND !empty($selectedSubCategory)) {
					$relationResult = $relationsCategory->issetRelation($selectedSubCategory, $selectedCategory);
					if (!empty($relationResult)) {
						$issetRelation = true;
						$errorMessage .= 'Выбраная вами подкатегория уже привязана к категории.';
					}
				}
				if ($resultSave === true) {
					$relationsCategory->subcategory = $model->getPrimaryKey();
					$relationsCategory->category = $selectedCategory;
					$relationsCategory->save();

					$message .= 'Созданая подкатегория была привязана к категории.';
				}
				if (!empty($selectedSubCategory) AND $issetRelation === false) {
					$relationsCategory->subcategory = $selectedSubCategory;
					$relationsCategory->category = $selectedCategory;
					$relationsCategory->save();

					$message .= 'Выбранная подкатегория была привязана к категории';
				}

				if (!empty($message)) Yii::$app->getSession()->setFlash('success', $message);
				if (!empty($errorMessage)) {
					Yii::$app->getSession()->setFlash('error', $errorMessage);
					return $this->redirect(['/subcategories/subcategories', 'id' => $model->id]);
				}

				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		$modelCategories = new Categories();
		$dropDownCategories = $modelCategories->getArrayDropDownCategories();
		$dropDownSubCategories = $model->getArrayDropDownSubCategories();

		return $this->render('create', [
			'model' => $model,
			'dropDownCategories' => $dropDownCategories,
			'dropDownSubCategories' => $dropDownSubCategories,
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
		$modelCategories = new Categories();
		$dropDownCategories = $modelCategories->getArrayDropDownCategories();
		$dropDownSubCategories = $model->getArrayDropDownSubCategories();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
			'dropDownCategories' => $dropDownCategories,
			'dropDownSubCategories' => $dropDownSubCategories,
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
