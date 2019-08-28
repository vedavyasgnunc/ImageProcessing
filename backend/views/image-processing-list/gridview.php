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
<?php //$modelsData = (array)$models[0]; echo(json_encode($modelsData));?>
    <?php $arrayData = array();
    foreach ($models as $model): 
    $arrayData[] = array('ip_job_id'=>$model->ip_job_id,'ip_image_id'=>$model->ip_image_id,'ip_category'=>$model->ip_category,'ip_image_url'=>$model->ip_image_url,'ip_img_class'=>$model->ip_img_class,'ip_img_object'=>json_decode($model->ip_img_object,true));
    endforeach; 
    $modelsData = json_encode($arrayData);
    echo $modelsData;
    ?>
<?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>
</div>
