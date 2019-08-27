<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-processing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ip_job_id') ?>

    <?= $form->field($model, 'ip_image_id') ?>

    <?= $form->field($model, 'ip_image_url') ?>

    <?= $form->field($model, 'ip_client_id') ?>

    <?= $form->field($model, 'ip_video_id') ?>

    <?php // echo $form->field($model, 'ip_video_fk') ?>

    <?php // echo $form->field($model, 'ip_category') ?>

    <?php // echo $form->field($model, 'ip_category_id') ?>

    <?php // echo $form->field($model, 'ip_img_class') ?>

    <?php // echo $form->field($model, 'ip_img_object') ?>

    <?php // echo $form->field($model, 'ip_posted_flag') ?>

    <?php // echo $form->field($model, 'ip_completed_flag') ?>

    <?php // echo $form->field($model, 'ip_error_flag') ?>

    <?php // echo $form->field($model, 'ip_error_message') ?>

    <?php // echo $form->field($model, 'ip_created_date') ?>

    <?php // echo $form->field($model, 'ip_modified_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
