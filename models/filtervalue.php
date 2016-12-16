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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filtervalue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filterkey_id'], 'integer'],
            [['created_at'], 'safe'],
            [['value'], 'string', 'max' => 36],
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
