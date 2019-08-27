<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */

$this->title = $model->ip_job_id;
$this->params['breadcrumbs'][] = ['label' => 'Image Processings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="image-processing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ip_job_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ip_job_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ip_job_id',
            'ip_image_id',
            'ip_image_url:url',
            'ip_client_id',
            'ip_video_id',
            'ip_video_fk',
            'ip_category',
            'ip_category_id',
            'ip_img_class:ntext',
            'ip_img_object:ntext',
            'ip_posted_flag',
            'ip_completed_flag',
            'ip_error_flag',
            'ip_error_message:ntext',
            'ip_created_date',
            'ip_modified_date',
        ],
    ]) ?>

</div>
