<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
        .form-controls-row {
            display: flex;
        }

        .form-controls-row .control {
            padding-right: 20px;
        }

        .custom-file-wrapper {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .custom-file-wrapper input {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            opacity: 0;
            cursor: pointer;
        }
        .file-name{
            padding: 4px;
        }
    </style>
<div class="image-processing-form">
    <?php $form = ActiveForm::begin(['id' => 'uploadForm','options' => ['style' => 'max-width: 50%;','method'=>'post']]); ?>
        <div class="form-controls-row">
            <div class="control">
                <?= $form->field($model, 'uploadType')->radio(['label' => 'HTML Upload', 'value' => 1, 'checked' => 'checked','id'=>'htmlUpload']) ?>
            </div>
            <div class="control">
                <?= $form->field($model, 'uploadType')->radio(['label' => 'Image Upload', 'value' => 2, 'uncheck' => null,'id'=>'imageUpload']) ?>
            </div>
        </div>
        <div id="htmlUploadDiv" >
            <div style="display: flex; align-items: center;margin: 20px 0;">
                <div class="custom-file-wrapper">
                    <button class="btn btn-outline btn-primary">Upload</button>
                    <?= $form->field($model, 'imageFile')->fileInput(["id"=>"htmlFileChoose"])->label(''); ?>
                </div>
                <div class="file-name" id="filename">

                </div>
            </div>
        </div>
        <div id="imageUploadDiv" style="display: none;">
            <div class="form-group" >
            <?= $form->field($model, 'ip_image_url')->textInput(["placeholder"=>"Image URL","class"=>"form-control"])->label(''); ?>
            </div>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'ip_image_segmentation_flag')->checkbox(array('label'=>'Image Segmentation','labelOptions'=>array('style'=>'padding:5px;')))->label(''); ?>
        </div>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
    <script>
        var form = document.getElementById('uploadForm');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log(this);
        });
        idOf('htmlUpload').addEventListener('change', function () {
            if (this.checked == true) {
                idOf('imageUploadDiv').style.display = "none";
                idOf('htmlUploadDiv').style.display = "block";
            }
        });
        idOf('imageUpload').addEventListener('change', function () {
            if (this.checked == true) {//this.value === 'on'
                idOf('imageUploadDiv').style.display = "block";
                idOf('htmlUploadDiv').style.display = "none";
            }
        });
        idOf('htmlFileChoose').addEventListener('change', function () {
            if (this.files.length) {
                idOf('filename').innerText = this.files[0].name;
            }
        });

        function idOf(id) {
            return document.getElementById(id)
        }
    </script>
</div>
