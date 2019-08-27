<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ava_image_category_domain".
 *
 * @property string $aicd_id
 * @property string $aicd_cat_text
 * @property int $aicd_ext
 * @property int $aicd_360_seq
 * @property string $imageurls
 * @property string $aicd_create_time
 * @property string $aicd_last_updated
 */
class ImageCategoryDomain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ava_image_category_domain';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aicd_ext', 'aicd_360_seq'], 'integer'],
            [['aicd_create_time'], 'required'],
            [['aicd_create_time', 'aicd_last_updated'], 'safe'],
            [['aicd_cat_text', 'imageurls'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aicd_id' => 'Aicd ID',
            'aicd_cat_text' => 'Aicd Cat Text',
            'aicd_ext' => 'Aicd Ext',
            'aicd_360_seq' => 'Aicd 360 Seq',
            'imageurls' => 'Imageurls',
            'aicd_create_time' => 'Aicd Create Time',
            'aicd_last_updated' => 'Aicd Last Updated',
        ];
    }
}
