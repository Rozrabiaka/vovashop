<?php

namespace backend\modules\relationscategory\controllers;

use backend\models\Categories;
use backend\models\RelationsCategory;
use backend\models\Subcategories;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * RelationsCategoryController implements the CRUD actions for RelationsCategory model.
 */
class RelationscategoryController extends Controller
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
	 * Lists all RelationsCategory models.
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
	 * Updates an existing RelationsCategory model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = new RelationsCategory();

		if (!empty(Yii::$app->request->post())) {
			$postData = Yii::$app->request->post('RelationsCategory')['checkbox'];
			$insertArray = array();

			if (!empty($postData)) {
				foreach ($postData as $key => $data) {
					$insertArray[] = array(
						'subcategory' => (int)$id,
						'category' => (int)$data,
					);
				}
			}
			//first we delete all by subcategory
			Yii::$app->db->createCommand()->delete($model::tableName(), ['subcategory' => $id])->execute();

			//after insert new data
			if (!empty($insertArray)) {
				Yii::$app->db->createCommand()->batchInsert($model::tableName(),
					['subcategory', 'category'],
					$insertArray
				)->execute();
			}

			Yii::$app->getSession()->setFlash('success', 'Данные были успешно обновлены.');
		}

		$modelCategories = new Categories();
		$allCategories = $modelCategories->getAllCategories();
		$relations = $model->issetRelation($id);

		$checkboxArray = array();
		$checkboxCheckedArray = array();
		foreach ($allCategories as $category) {
			$checkboxArray[$category->id] = $category->name;
			foreach ($relations as $data) {
				if ($category->id == $data->category) {
					$checkboxCheckedArray[$category->id] = $category->id;
					break;
				}
			}
		}

		$model->checkbox = $checkboxCheckedArray;

		return $this->render('update', [
			'checkboxArray' => $checkboxArray,
			'model' => $model
		]);
	}
}
