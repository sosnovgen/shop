<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class Articles extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'articles';
    }

    /*-----------------------------------------------------------*/
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getAtribute()
    {
        return $this->hasOne(Atribute::className(), ['id' => 'attr_id']);
    }

/*    public function getCategoryTitle()
    {
        $category = $this -> category;

        return $category ? $category -> title : '';
    }*/

    /*-----------------------------------------------------------*/
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body'], 'string'],
            [['category_id', 'attr_id'], 'integer'],
            [['cena'], 'number'],
            [['created_at'], 'safe'],
            [['title', 'preview', 'group_id'], 'string', 'max' => 128],
            [['meta_description', 'meta_keywords'], 'string', 'max' => 255],
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
