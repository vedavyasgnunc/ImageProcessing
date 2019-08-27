<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageCategoryDomainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-category-domain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'aicd_id') ?>

    <?= $form->field($model, 'aicd_cat_text') ?>

    <?= $form->field($model, 'aicd_ext') ?>

    <?= $form->field($model, 'aicd_360_seq') ?>

    <?= $form->field($model, 'imageurls') ?>

    <?php // echo $form->field($model, 'aicd_create_time') ?>

    <?php // echo $form->field($model, 'aicd_last_updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
