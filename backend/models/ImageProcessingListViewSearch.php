<?php

namespace backend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImageProcessingList;

/**
 * ImageProcessingSearch represents the model behind the search form of `backend\models\ImageProcessingList`.
 */
class ImageProcessingListViewSearch extends ImageProcessingList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip_job_id', 'ip_image_id', 'ip_client_id', 'ip_video_id', 'ip_category_id', 'ip_posted_flag', 'ip_completed_flag', 'ip_error_flag'], 'integer'],
            [['ip_image_url', 'ip_video_fk', 'ip_category', 'ip_img_class', 'ip_img_object', 'ip_error_message', 'ip_created_date', 'ip_modified_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ImageProcessingList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params)
         * statement below
         */
        $dataProvider->setSort([
            'attributes' => [
                'ip_created_date' => [
                    'asc' => ['ip_created_date' => SORT_ASC],
                    'desc' => ['ip_created_date' => SORT_DESC],
                ],
                'ip_modified_date' => [
                    'asc' => ['ip_modified_date' => SORT_ASC],
                    'desc' => ['ip_modified_date' => SORT_DESC],
                ]
            ],
            'defaultOrder' => ['ip_modified_date'=>SORT_DESC]
        ]);
 
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dateVal = Yii::$app->request->get('date');
        // grid filtering conditions
        $query->andFilterWhere([
            'ip_modified_date' => $this->ip_modified_date,
        ]);
        if(!empty($dateVal)){
            $query->andFilterWhere(['like', 'DATE(ip_created_date)', $dateVal]);
        }
        $query->andFilterWhere(['like', 'countImages', $this->countImages]);

       /* $query->andFilterWhere(['like', 'ip_image_url', $this->ip_image_url])
            ->andFilterWhere(['like', 'ip_video_fk', $this->ip_video_fk])
            ->andFilterWhere(['like', 'ip_category', $this->ip_category])
            ->andFilterWhere(['like', 'ip_img_class', $this->ip_img_class])
            ->andFilterWhere(['like', 'ip_img_object', $this->ip_img_object])
            ->andFilterWhere(['like', 'ip_error_message', $this->ip_error_message]);*/
        
        return $dataProvider;
    }
}
