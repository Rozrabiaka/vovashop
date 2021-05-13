<?php

namespace backend\models;

use yii\data\ActiveDataProvider;

class OrdersSearch extends \backend\models\Orders
{
    public function rules()
    {
        return [
            [['price', 'product_id', 'status', 'payment_type', 'order_number', 'delivery_type', 'address', 'phone', 'qty'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 10,
            ],
        ]);


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $params = $params['OrdersSearch'];

        if (!empty($params['product_id'])) $query->andWhere(['=', 'product_id', $params['product_id']]);
        if (!empty($params['price'])) $query->andWhere(['<=', 'price', $params['price']]);
        if (!empty($params['status'])) $query->andWhere(['=', 'status', $params['status']]);
        if (!empty($params['order_number'])) $query->andWhere(['like', 'order_number', $params['order_number']]);
        if (!empty($params['delivery_type'])) $query->andWhere(['=', 'delivery_type', $params['delivery_type']]);
        if (!empty($params['payment_type'])) $query->andWhere(['=', 'payment_type', $params['payment_type']]);
        if (!empty($params['address'])) $query->andWhere(['like', 'address', $params['address']]);
        if (!empty($params['qty'])) $query->andWhere(['like', 'qty', $params['qty']]);
        if (!empty($params['phone'])) $query->andWhere(['like', 'phone', $params['phone']]);

        return $dataProvider;

    }
}
