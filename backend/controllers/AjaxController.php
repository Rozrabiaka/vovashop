<?php

namespace backend\controllers;

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

			$model = new Subcategories();
			$result = $model::find()->where(['category_id' => $data['category_id']])->asArray()->all();

			if (!empty($result)) {
				return JSON::encode($result);
			}
		}

		return JSON::encode(null);;
	}
}