<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\Category;
use yii\bootstrap\Modal;

?>

<h3></h3>
<br>
<?php
Modal::begin([
'header' => '<h2>Hello world</h2>',
'toggleButton' => ['label' => 'click me', ],
]);

echo 'Say hello...';

Modal::end();

?>
