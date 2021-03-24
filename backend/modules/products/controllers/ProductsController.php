<?php

namespace backend\modules\products\controllers;

use backend\models\Categories;
use backend\models\Marks;
use backend\models\ProductsImage;
use Yii;
use backend\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
	 * Lists all Products models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Products::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Products model.
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
	 * Creates a new Products model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Products();
		$productsImage = new ProductsImage();

		if ($model->load(Yii::$app->request->post())) {

			if (Yii::$app->request->post('Products')['subcategory_id'] == 'prompt') $model->subcategory_id = null;

			$model->date = date("Y-m-d H:i:s");
			$model->user_added = Yii::$app->user->id;
			$model->image = UploadedFile::getInstances($model, 'image');

			if ($model->save()) {
				if (!is_null($model->image)) {
					$uploadPath = '/web' . Yii::getAlias('@uploads') . '/products/' . date('Y') . '/' . date('m');
					$path = Yii::getAlias('@frontend') . $uploadPath;
					if (!is_dir($path))
						mkdir($path, 0777, true);

					$productId = $model->getPrimaryKey();
					$productImageArray = array();
					foreach ($model->image as $file) {
						$fileName = md5(microtime() . rand(0, 9999)) . '_' . $file->name;
						$imagePath = $path . '/' . $fileName;
						if ($file->saveAs($imagePath)) {
							$productImageArray[] = array(
								'product_id' => (int)$productId,
								'image_path' => $uploadPath . '/' . $fileName
							);
						}
					}

					//save to product image table path
					Yii::$app->db->createCommand()->batchInsert(
						ProductsImage::tableName(),
						['product_id', 'image_path'],
						$productImageArray
					)->execute();
				}

				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				var_dump($model->errors);
				Yii::$app->getSession()->setFlash('error', 'Произошла ошибка при добавление товара, пожалуйста повторите сново.');
			}
		}

		$modelCategories = new Categories();
		$modelMarks = new Marks();

		$allCategories = $modelCategories->getArrayDropDownCategories();
		$allMarks = $modelMarks->getArrayDropDownMarks();
		$productStatus = $model->getStatusToDropDownList();
		//подключаем JS
		\Yii::$app->getView()->registerJsFile('@web/js/products/subcategoriesDropDown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('create', [
			'productsImage' => $productsImage,
			'productStatus' => $productStatus,
			'allMarks' => $allMarks,
			'allCategories' => $allCategories,
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Products model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Products model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		$modelProductImage = new ProductsImage();
		$images = $modelProductImage::find()->where(['product_id' => $id])->asArray()->all();

		foreach ($images as $data) {
			if (file_exists(Yii::getAlias('@frontend') . $data['image_path'])) {
				unlink(Yii::getAlias('@frontend') . $data['image_path']);
			}
			$delete = \Yii::$app
				->db
				->createCommand()
				->delete('products_image', ['id' => $data['id']])
				->execute();
		}

		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Products model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Products the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Products::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
