<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */

$this->title = $model->ip_job_id;
$this->params['breadcrumbs'][] = ['label' => 'Image Processings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="image-processing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?/*= Html::a('Update', ['update', 'id' => $model->ip_job_id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->ip_job_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>-->

    <div class="wrapper">
        <style>
            .selection-box{
                background-color: transparent;
                border: 2px solid red;
                position: absolute;
                z-index:100;
            }
            .title-box{
                background-color: black;
                color : white;
                padding : 10px;
                position: absolute;
                z-index:300;
                display: none;
            }
            .hotspots_display_wrapper{
                position: relative;
            }
            div.img_class_grid_gallery {
                border: 1px solid #ccc;
            }
            .img_class_grid_gallery .desc {
                text-align: center;
            }
            .hotspots_display_wrapper{
                max-width: 960px;
                margin: auto;
            }
        </style>
        <div>
            <h3><?=$model->ip_category;?></h3>
        </div>
        <div id="wrapper" class="hotspots_display_wrapper">
            <img src="<?=$model->ip_image_url;?>" style="width: 100%;" alt="<?=$model->ip_category;?>" id="wrapper-image"/>
        </div>
    </div>
    <script>
        var annotations = [<?=json_encode(json_decode($model->ip_img_object));?>];
        var image = document.getElementById('wrapper-image');
        image.onload = function () {
            annotations[0]["object"].forEach(function (item) {
                var selection = createDiv(item.X1,item.Y1,item.X2,item.Y2,image.clientWidth, image.clientHeight,item.Label, image.naturalWidth, image.naturalHeight)
                document.getElementById('wrapper').append(selection);
                selection.addEventListener('mouseover', function (event) {
                    displayTitle(event);
                });

                selection.addEventListener('mouseout', function (event) {
                    hideTitle(selection, event);
                });
            })
        };
        function createDiv(x, y, w, h, iw, ih, title,nw,nh) {
            //console.log(x, y, w, h, iw, ih, title);
            var scale = iw/nw;
            var box = document.createElement('div');
            box.classList.add('selection-box');
            box.style.top = (y*scale) + "px";
            box.style.left = (x*scale) + "px";
            box.style.width = Math.abs((w - x)*scale) + "px";
            box.style.height = Math.abs((h - y)*scale) + "px";
            box.setAttribute("data-title", title);
            return box;
        }
        function displayTitle(event) {
            var titleDiv = document.createElement('div');
            titleDiv.innerText = event.target.getAttribute('data-title');
            titleDiv.style.position = 'absolute';
            titleDiv.style.top = event.offsetY + 10 + "px";
            titleDiv.style.left = event.offsetX + 10 + "px";
            titleDiv.style.backgroundColor = "black";
            titleDiv.style.color = "white";
            titleDiv.style.padding = "10px";
            titleDiv.style.display = "block";
            event.target.style.backgroundColor = "rgba(0, 0, 0, 0.2)";
            event.target.appendChild(titleDiv);
        }

        function hideTitle(element, event) {
            element.removeChild(element.firstChild);
            event.target.style.backgroundColor = "transparent";
        }
    </script>
</div>
