<?php

namespace frontend\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Search extends Model
{
    public $q;
    public $priceFrom;
    public $priceTo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['q'], 'string'],
            [['priceFrom', 'priceTo'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'priceFrom' => 'От',
            'priceTo' => 'До',
        ];
    }
}
