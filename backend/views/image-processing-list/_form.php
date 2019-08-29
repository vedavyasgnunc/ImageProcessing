<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageProcessing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-processing-form">

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
    <form id="uploadForm" method="post" style="max-width: 50%;">
        <div class="form-controls-row">
            <div class="control">
                <input type="radio" name="uploadType" id="htmlUpload" checked/>
                <label for="htmlUpload">HTML Upload</label>
            </div>
            <div class="control">
                <input type="radio" name="uploadType" id="imageUpload"/>
                <label for="imageUpload">Image Upload</label>
            </div>
        </div>
        <div id="htmlUploadDiv" >
            <div style="display: flex; align-items: center;margin: 20px 0;">
                <div class="custom-file-wrapper">
                    <button class="btn btn-outline btn-primary">Upload</button>
                    <input type="file" id="htmlFileChoose" name="htmlFile">
                </div>
                <div class="file-name" id="filename">

                </div>
            </div>
        </div>
        <div id="imageUploadDiv" style="display: none;">
            <div class="form-group" style="margin: 20px 0;">
            <input type="text" class="form-control" name="imageUrl" placeholder="Image URL"/>
            </div>
        </div>
        <div class="form-group" style="margin: 20px 0;">
            <input type="checkbox" class="form" name="imageSegmentation" id="imageSegmentation"/>
            <label for="imageSegmentation">Image Segmentation</label>
        </div>
        <button class="btn btn-success"type="submit">Save</button>
    </form>
    <script>
        var form = document.getElementById('uploadForm');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log(this);
        });
        idOf('htmlUpload').addEventListener('change', function () {
            if (this.value === 'on') {
                idOf('imageUploadDiv').style.display = "none";
                idOf('htmlUploadDiv').style.display = "block";
            }
        });
        idOf('imageUpload').addEventListener('change', function () {
            if (this.value === 'on') {
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
