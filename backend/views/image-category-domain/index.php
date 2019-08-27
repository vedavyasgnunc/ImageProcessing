<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageCategoryDomainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Image Category Domains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-category-domain-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Image Category Domain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'aicd_id',
            'aicd_cat_text',
            'aicd_ext',
            'aicd_360_seq',
            'imageurls',
            //'aicd_create_time',
            //'aicd_last_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
