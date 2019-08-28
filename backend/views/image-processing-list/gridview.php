<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grid View Image Processings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-processing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($models as $model): ?>
   <?= $model->ip_image_id; ?>
   <?= "<img scr='".$model->ip_image_url."' />"; ?>
   <?= $model->ip_img_object; ?>
   <?= $model->ip_category; ?>
   <br/>
<?php endforeach; ?>
<?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>
</div>
