<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageCategoryDomain */

$this->title = 'Create Image Category Domain';
$this->params['breadcrumbs'][] = ['label' => 'Image Category Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-category-domain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
