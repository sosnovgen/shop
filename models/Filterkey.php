<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "filterkey".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $key
 * @property string $priznak
 * @property string $created_at
 */
class Filterkey extends \yii\db\ActiveRecord
{

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function tableName()
    {
        return 'filterkey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['created_at'], 'safe'],
            ['enable','default', 'value' => '0'],
            [['key', 'priznak'], 'string', 'max' => 36],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
