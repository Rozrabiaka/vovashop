<?php

namespace backend\modules\products\controllers;

use backend\models\Categories;
use backend\models\CourseDollar;
use backend\models\Marks;
use backend\models\ProductColors;
use backend\models\ProductsAttributes;
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
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC,
				]
			],
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
		$productAttributes = new ProductsAttributes();

		if ($model->load(Yii::$app->request->post())) {

			if (Yii::$app->request->post('Products')['subcategory_id'] == 'prompt') $model->subcategory_id = null;
			if (!empty(Yii::$app->request->post('Products')['dollar_price'])) {
				$dollarsInDollars = Yii::$app->request->post('Products')['dollar_price'];

				$courseModel = new CourseDollar();
				$course = $courseModel->getCourse();
				if (is_null($course)) {
					Yii::$app->getSession()->setFlash('error', 'Вы пытаетесь добавить продукт по курсу доллара. Пожалуйста, выставите курс доллара и сделайте попытку сново.');
					return $this->redirect(['create']);
				}

				$uaPrice = $dollarsInDollars * $course;

				$model->price = $uaPrice;
			}

			$model->date = date("Y-m-d H:i:s");
			$model->user_added = Yii::$app->user->id;
			$model->image = UploadedFile::getInstances($model, 'image');
			$model->price = $uaPrice;

			if ($model->save()) {
				if (!is_null($model->image)) {
					$uploadPath = Yii::getAlias('@uploads') . '/products/' . date('Y') . '/' . date('m');
					$path = Yii::getAlias('@frontend') . '/web' . $uploadPath;
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

					//save product attributes
					$productAttributes->load(Yii::$app->request->post());
					$productAttributes->product_id = $productId;
					$productAttributes->save();
				}

				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				Yii::$app->getSession()->setFlash('error', 'Произошла ошибка при добавление товара, пожалуйста повторите сново.');
			}
		}

		$modelCategories = new Categories();
		$modelMarks = new Marks();
		$modelColors = new ProductColors();


		$allCategories = $modelCategories->getArrayDropDownCategories();
		$allMarks = $modelMarks->getArrayDropDownMarks();
		$productStatus = $model->getStatusToDropDownList();
		$productColors = $modelColors->getArrayDropDownColors();

		//подключаем JS
		\Yii::$app->getView()->registerJsFile('@web/js/products/subcategoriesDropDown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('create', [
			'productsImage' => $productsImage,
			'productStatus' => $productStatus,
			'allMarks' => $allMarks,
			'allCategories' => $allCategories,
			'productColors' => $productColors,
			'productAttributes' => $productAttributes,
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

//		if ($model->load(Yii::$app->request->post()) && $model->save()) {
//			return $this->redirect(['view', 'id' => $model->id]);
//		}

		$modelCategories = new Categories();
		$modelMarks = new Marks();

		$allCategories = $modelCategories->getArrayDropDownCategories();
		$allMarks = $modelMarks->getArrayDropDownMarks();
		$productStatus = $model->getStatusToDropDownList();

		//подключаем JS
		\Yii::$app->getView()->registerJsFile('@web/js/products/subcategoriesDropDown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('update', [
			'allMarks' => $allMarks,
			'allCategories' => $allCategories,
			'productStatus' => $productStatus,
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
