<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "course_dollar".
 *
 * @property int $id
 * @property int $course
 */
class CourseDollar extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'course_dollar';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['course'], 'required'],
			[['course'], 'number'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'course' => 'Course',
		];
	}

	public function getCourse()
	{
		$course = self::find()->one();
		if (!empty($course)) {
			return $course->course;
		}

		return null;
	}
}
