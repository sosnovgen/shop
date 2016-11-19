<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class Atribute extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'atribute';
    }

    /*-----------------------------------------------------------*/


    /*-----------------------------------------------------------*/
    public function rules()
    {
        return [
            [['category_id','articles_id'], 'integer'],
            [['key','value'], 'string', 'max' => 128],
            [['created_at'], 'safe'],

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
