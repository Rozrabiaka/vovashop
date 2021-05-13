<?php

namespace common\widgets;

use backend\models\Categories;
use yii\base\Widget;

class CategoryHeaderMenuWidget extends Widget
{
    public function run()
    {
        $model = Categories::find()->asArray()->all();

        return $this->render('categoryMenu', [
            'model' => $model
        ]);
    }
}