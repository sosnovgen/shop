<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\Category;
use app\models\Atribute;
?>

<h4>Test</h4>
<br>
<?php

    $session = Yii::$app->session;
    $row = $session['Наушники'];
     var_dump($row);


 ?>