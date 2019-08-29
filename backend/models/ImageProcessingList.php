<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ava_image_processing".
 *
 * @property int $ip_job_id
 * @property int $ip_image_id
 * @property string $ip_image_url
 * @property int $ip_client_id
 * @property int $ip_video_id
 * @property string $ip_video_fk
 * @property string $ip_category
 * @property int $ip_category_id
 * @property string $ip_img_class
 * @property string $ip_img_object
 * @property int $ip_posted_flag
 * @property int $ip_completed_flag
 * @property int $ip_error_flag
 * @property string $ip_error_message
 * @property string $ip_created_date
 * @property string $ip_modified_date
 */
class ImageProcessingList extends \yii\db\ActiveRecord
{
    public $countImages, $imageFile, $uploadType;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ava_image_processing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip_client_id', 'ip_video_id', 'ip_category_id', 'ip_posted_flag', 'ip_completed_flag', 'ip_image_segmentation_flag', 'ip_error_flag','countImages'], 'integer'],
            [['ip_image_id','ip_img_class', 'ip_img_object', 'ip_error_message','imageFile','ip_segmentation_object'], 'string'],
            [['ip_created_date', 'ip_modified_date'], 'safe'],
            [['ip_image_url','uploadType'], 'string', 'max' => 255],
            [['ip_video_fk', 'ip_category','ip_job_fk'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ip_job_id' => 'Ip Job ID',
            'ip_job_fk' => 'Ip Job FK',
            'ip_image_id' => 'Ip Image ID',
            'ip_image_url' => 'Ip Image Url',
            'ip_client_id' => 'Ip Client ID',
            'ip_video_id' => 'Ip Video ID',
            'ip_video_fk' => 'Ip Video Fk',
            'ip_category' => 'Ip Category',
            'ip_category_id' => 'Ip Category ID',
            'ip_img_class' => 'Ip Img Class',
            'ip_img_object' => 'Ip Img Object',
            'ip_posted_flag' => 'Ip Posted Flag',
            'ip_segmentation_object' => 'Ip Image Segementation',
            'ip_completed_flag' => 'Ip Completed Flag',
            'ip_error_flag' => 'Ip Error Flag',
            'ip_error_message' => 'Ip Error Message',
            'ip_created_date' => 'Date',
            'ip_modified_date' => 'Ip Modified Date',
            'countImages' => 'Images Count',
        ];
    }
}
