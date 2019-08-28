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
<?php $modelsData = (array)$models[0]; echo(json_encode($modelsData));?>
<?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>
</div>
