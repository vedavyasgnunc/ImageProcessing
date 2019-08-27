<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */

$this->title = 'Update Image Processing: ' . $model->ip_job_id;
$this->params['breadcrumbs'][] = ['label' => 'Image Processings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ip_job_id, 'url' => ['view', 'id' => $model->ip_job_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-processing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
