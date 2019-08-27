<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-processing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ip_image_id')->textInput() ?>

    <?= $form->field($model, 'ip_image_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_client_id')->textInput() ?>

    <?= $form->field($model, 'ip_video_id')->textInput() ?>

    <?= $form->field($model, 'ip_video_fk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_category_id')->textInput() ?>

    <?= $form->field($model, 'ip_img_class')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip_img_object')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip_posted_flag')->textInput() ?>

    <?= $form->field($model, 'ip_completed_flag')->textInput() ?>

    <?= $form->field($model, 'ip_error_flag')->textInput() ?>

    <?= $form->field($model, 'ip_error_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip_created_date')->textInput() ?>

    <?= $form->field($model, 'ip_modified_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
