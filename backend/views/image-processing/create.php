<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */

$this->title = 'Create Image Processing';
$this->params['breadcrumbs'][] = ['label' => 'Image Processings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-processing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
