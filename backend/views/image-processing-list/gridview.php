<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grid View Image Processings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-processing-index">

    <h1><?= Html::encode($this->title) ?></h1>
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
        .grid-thumb{
            display: inline-block;
            float: left;
            width: 33%;
            position: relative;
            padding: 1rem;
        }
        .grid-thumb img{
            width: 100%;
        }
        .grid-thumb-container{
            border: 1px solid #8b8b8b;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            position: relative;
        }
        .grid-thumb-container a{
            display: block;
            margin: 5px;
            color: #000;
            text-decoration: none;
        }
    </style>
    <div class="wrapper" id="main_wrapper">

    </div>
    <?php $arrayData = array();
    foreach ($models as $model): 
    $arrayData[] = array('ip_job_id'=>$model->ip_job_id,'ip_image_id'=>$model->ip_image_id,'ip_category'=>$model->ip_category,'ip_image_url'=>$model->ip_image_url,'ip_img_class'=>json_decode($model->ip_img_class,true),'ip_img_object'=>json_decode($model->ip_img_object,true));
    endforeach; 
    $modelsData = json_encode($arrayData);
    ?>
    <script>
        var annotations = <?=$modelsData;?>;
        if(annotations && annotations.length){
            annotations.forEach(function (item) {
                // elem is the grid item inside the wrapper
                var elem = document.createElement('div');
                elem.classList.add('grid-thumb');
                document.getElementById('main_wrapper').append(elem);

                // container is the child to elem containing all images and titles
                var container = document.createElement('div');
                container.classList.add('grid-thumb-container');
                elem.append(container);

                // elemImage is the image element inside the grid thumbnail
                var elemImage = new Image();
                elemImage.onload = function(){
                    if(item.ip_img_object) {
                        item.ip_img_object["object"].forEach(function (item) {

                            // selection is the element for every single annotaion present for that image
                            console.log(elemImage.clientWidth)
                            var selection = createDiv(item.X1, item.Y1, item.X2, item.Y2, elemImage.clientWidth, elemImage.clientHeight, item.Label, elemImage.naturalWidth, elemImage.naturalHeight)
                            container.append(selection);
                            selection.addEventListener('mouseover', function (event) {
                                displayTitle(event);
                            });
                            selection.addEventListener('mouseout', function (event) {
                                hideTitle(selection, event);
                            });
                        })
                    }
                };
                elemImage.src = item.ip_image_url;
                container.append(elemImage);

                // title is the title element of the image
                var title = document.createElement('a');
                title.href = '?r=image-processing%2Fview&id='+item.ip_job_id;
                title.innerText = item.ip_category;
                container.append(title)
            })
        }
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
        console.log(annotations);
    </script>

    <div style="clear: both;">
    <?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>
    </div>
</div>
