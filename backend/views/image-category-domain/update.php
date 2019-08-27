<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageCategoryDomain */

$this->title = 'Update Image Category Domain: ' . $model->aicd_id;
$this->params['breadcrumbs'][] = ['label' => 'Image Category Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aicd_id, 'url' => ['view', 'id' => $model->aicd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-category-domain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
