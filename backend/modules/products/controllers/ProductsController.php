<?php

namespace backend\modules\products\controllers;

use backend\models\Categories;
use backend\models\CourseDollar;
use backend\models\Marks;
use backend\models\ProductColors;
use backend\models\ProductColorsRelations;
use backend\models\ProductsAttributes;
use backend\models\ProductsAttributesMultiple;
use backend\models\ProductsImage;
use backend\models\Subcategories;
use Yii;
use backend\models\Products;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
        $modelProductsAttributesMultiple = new ProductsAttributesMultiple();

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

            if ($model->save()) {
                if (!is_null($model->image)) {
                    $model->uploadImages();
                    $productId = $model->getPrimaryKey();

                    //save colors to table
                    $choosedColors = Yii::$app->request->post('Products')['colors'];
                    if (!empty($choosedColors)) {
                        $colors = array();
                        foreach ($choosedColors as $color) {
                            $colors[] = array(
                                'color_id' => $color,
                                'product_id' => (int)$productId
                            );
                        }
                        Yii::$app->db->createCommand()->batchInsert(
                            ProductColorsRelations::tableName(),
                            ['color_id', 'product_id'],
                            $colors
                        )->execute();
                    }

                    //save product attributes
                    $productAttributes->load(Yii::$app->request->post());
                    $productAttributes->product_id = $productId;
                    $productAttributes->save();

                    if (!empty(Yii::$app->request->post('ProductsAttributesMultiple'))) {
                        $postMultipleAttributesData = Yii::$app->request->post('ProductsAttributesMultiple');
                        $multipleAttributes = array();
                        $i = 0;
                        foreach ($postMultipleAttributesData as $key => $attributesData) {
                            foreach ($attributesData as $data) {
                                if ($key == 'frame_number') {
                                    $multipleAttributes[] = array(
                                        'product_id' => $productId,
                                        'frame_number' => $data,
                                    );
                                }
                                if ($key == 'engine_number') {
                                    $multipleAttributes[$i]['engine_number'] = $data;
                                    $i++;
                                }
                            }
                        }

                        Yii::$app->db->createCommand()->batchInsert(
                            ProductsAttributesMultiple::tableName(),
                            ['product_id', 'frame_number', 'engine_number'],
                            $multipleAttributes
                        )->execute();
                    }
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
            'modelProductsAttributesMultiple' => $modelProductsAttributesMultiple,
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
        $productAttributes = ProductsAttributes::find()->where(['product_id' => $id])->one();

        if ($model->load(Yii::$app->request->post())) {
            if (empty(Yii::$app->request->post('Products')['subcategory_id'])) $model->subcategory_id = null;
            if ($model->save()) {
                $model->image = UploadedFile::getInstances($model, 'image');
                if (!is_null($model->image)) {
                    $model->uploadImages();
                }

                //update product attributes
                $productAttributes->load(Yii::$app->request->post());
                $productAttributes->update();

                return $this->redirect(['view', 'id' => $id]);
            }
        }

        $modelCategories = new Categories();
        $modelMarks = new Marks();

        $allCategories = $modelCategories->getArrayDropDownCategories();
        $allMarks = $modelMarks->getArrayDropDownMarks();
        $productStatus = $model->getStatusToDropDownList();

        $result = Subcategories::find()
            ->select(['subcategories.id', 'subcategories.name'])
            ->leftJoin('relations_category', 'subcategories.id = relations_category.subcategory')
            ->where(['category' => $model->category_id])
            ->asArray()
            ->all();

        $productSubCategories = array();
        if (!empty($result)) {
            $productSubCategories = ArrayHelper::map($result, 'id', 'name');
        }

        //подключаем JS
        \Yii::$app->getView()->registerJsFile('@web/js/products/subcategoriesDropDown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

        return $this->render('update', [
            'allMarks' => $allMarks,
            'allCategories' => $allCategories,
            'productStatus' => $productStatus,
            'productSubCategories' => $productSubCategories,
            'productAttributes' => $productAttributes,
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
            if (file_exists(Yii::getAlias('@frontend') . '/web' . $data['image_path'])) {
                unlink(Yii::getAlias('@frontend') . '/web' . $data['image_path']);
            }
        }

        //delete images
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('products_image', ['product_id' => $id])
            ->execute();

        //delete relation attributes
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('products_attributes', ['product_id' => $id])
            ->execute();

        //delete relation colors
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('product_colors_relations', ['product_id' => $id])
            ->execute();

        //delete multiple attributes
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('products_attributes_multiple', ['product_id' => $id])
            ->execute();

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
