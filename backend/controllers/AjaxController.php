<?php

namespace backend\controllers;

use backend\models\ProductsImage;
use backend\models\Subcategories;
use yii\web\Controller;
use Yii;
use yii\helpers\Json;

class AjaxController extends Controller
{
	public function actionCategory()
	{
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->get();
			$categoryId = $data['category_id'];

			$result = Subcategories::find()
				->select(['subcategories.id', 'subcategories.name'])
				->leftJoin('relations_category', 'subcategories.id = relations_category.subcategory')
				->where(['category' => $categoryId])
				->asArray()
				->all();

			if (!empty($result)) {
				return JSON::encode($result);
			}
		}

		return JSON::encode(null);
	}

	public function actionDeleteProductImage()
	{

		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$id = $data['key'];

			$model = new ProductsImage();
			$result = $model::find()->where(['id' => $id])->one();

			if (file_exists(Yii::getAlias('@frontend') . '/web' . $result->image_path)) {
				unlink(Yii::getAlias('@frontend') . '/web' . $result->image_path);
			}

			$result->delete();

			return true;
		}

		return false;
	}
}