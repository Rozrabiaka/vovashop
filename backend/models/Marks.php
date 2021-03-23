<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marks".
 *
 * @property int $id
 * @property string $name
 */
class Marks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

	public function issetMarkNyName($name)
	{
		return self::find()->where(['name' => $name])->one();
	}
}
