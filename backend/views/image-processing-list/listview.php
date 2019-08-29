<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageProcessingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List View Vision';
$this->params['breadcrumbs'][] = 'List View Vision';
?>
<div class="image-processing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'ip_job_id',
            'ip_image_id',
            'ip_image_url:url',
            //'ip_client_id',
            //'ip_video_id',
            //'ip_video_fk',
            'ip_category',
            //'ip_category_id',
            //'ip_img_class:ntext',
            //'ip_img_object:ntext',
            //'ip_posted_flag',
            //'ip_completed_flag',
            //'ip_error_flag',
            'ip_error_message:ntext',
            
            //'ip_modified_date',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;', $url, [
                        'title' => Yii::t('app', 'GridView'),
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url = Url::to(['image-processing-list/view', 'id' =>$model->ip_image_id]);
                    return $url;
                }
            }
        ],
    ]
]); 
?>
</div>
