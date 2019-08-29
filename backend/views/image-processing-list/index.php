<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageProcessingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vision';
$this->params['breadcrumbs'][] = 'Vision';
?>
<div class="image-processing-index">

    <h1><?= Html::encode('Vision') ?></h1>

    <p>
        <?= Html::a('Upload Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'ip_job_id',
            'ip_modified_date:date',
            'countImages',
            //'ip_image_id',
            //'ip_image_url:url',
            //'ip_client_id',
            //'ip_video_id',
            //'ip_video_fk',
            //'ip_category',
            //'ip_category_id',
            //'ip_img_class:ntext',
            //'ip_img_object:ntext',
            //'ip_posted_flag',
            //'ip_completed_flag',
            //'ip_error_flag',
            //'ip_error_message:ntext',
            
            //'ip_modified_date',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{gridview}{listview}',
            'buttons' => [
                'gridview' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp;', $url, [
                        'title' => Yii::t('app', 'GridView'),
                    ]);
                },
                'listview' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-list"></span>', $url, [
                        'title' => Yii::t('app', 'ListView'),

                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'gridview') {
                    $url = Url::to(['image-processing-list/gridview', 'date' => date("Y-m-d",strtotime($model->ip_modified_date))]);
                    return $url;
                }
                if ($action === 'listview') {
                    $url = Url::to(['image-processing-list/listview', 'date' => date("Y-m-d",strtotime($model->ip_modified_date))]);
                    return $url;
                }
            }
        ],
    ]
]); 
?>
</div>
