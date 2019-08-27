<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageCategoryDomain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-category-domain-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aicd_cat_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aicd_ext')->textInput() ?>

    <?= $form->field($model, 'aicd_360_seq')->textInput() ?>

    <?= $form->field($model, 'imageurls')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aicd_create_time')->textInput() ?>

    <?= $form->field($model, 'aicd_last_updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
