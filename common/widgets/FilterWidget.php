<?php

namespace common\widgets;

use frontend\models\Search;
use yii\base\Widget;

class FilterWidget extends Widget
{
    public function run()
    {
        $model = new Search();
        return $this->render('filter', [
            'model' => $model
        ]);
    }
}