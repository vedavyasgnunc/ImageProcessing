<?php

namespace backend\controllers;

use Yii;
use backend\models\ImageProcessing;
use backend\models\ImageProcessingList;
use backend\models\ImageProcessingListSearch;
use backend\models\ImageProcessingListViewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\components\commonComponent;
use yii\web\UploadedFile;
use yii\helpers\Url;
use Google\Cloud\Storage\StorageClient;

/**
 * ImageProcessingController implements the CRUD actions for ImageProcessing model.
 */
class ImageProcessingListController extends Controller
{
    
    var $CONTENT_TYPE = "Content-Type: application/json";
    var $ACCOUNT_KEY = "account-key:D1234567-D123-D123-D123-D12345678910";
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ImageProcessing models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!commonComponent::ipAddressValidation()){
            session_destroy();
            Yii::$app->user->logout();
            Yii::$app->session->setFlash('error', 'Contact Vendor for more details.');
            return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
        }
        $searchModel = new ImageProcessingListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImageProcessing model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel(array('ip_image_id'=>$id)),
        ]);
    }

    /**
     * Displays a single ImageProcessing model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGridview($date)
    {
        $query = ImageProcessing::find()
                ->select(['*']);
        if(!empty($date)){
            $query->andFilterWhere(['like', 'DATE(ip_modified_date)', $date]);
        }
        // get the total number of users
        $count = $query->count();
        //creating the pagination object
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 16]);
        //limit the query using the pagination and retrieve the users
        $models = $query->offset($pagination->offset)
           ->limit($pagination->limit)
           ->all();
        return $this->render('gridview', [
           'models' => $models,
           'pagination' => $pagination,
        ]);
    }
    
    public function PostServiceIDS($service_url, $data_array)
{
    $curl_json_response = $curl = "";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $service_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array($this->ACCOUNT_KEY));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data_array));
    $curl_response = curl_exec($curl);
    if (!$curl_response) {
        $curl_json_response = '{"error" : "400","message" : "Rest Connection Failure"}';
    } else {
        $curl_json_response = $curl_response;
    }
    $curl_info = curl_getinfo($curl);
    curl_close($curl);
    return $curl_json_response;
}
    
    /**
     * Displays a single ImageProcessing model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionListview($date)
    {
        $searchModel = new ImageProcessingListViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Creates a new ImageProcessing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImageProcessingList();

        if ($model->load(Yii::$app->request->post()) )
        {
            $img_guid = commonComponent::authFkey();
            
            if($model->uploadType==1){
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if(!empty($model->imageFile) && $model->imageFile->size !== 0)
                {
                   $extension = $model->imageFile->getExtension();
                    if ($model->imageFile) {
                        
                        $path = Yii::getAlias('@frontend')  .'/imagesProcessed/';
                        $model->imageFile->saveAs($path . $img_guid . '.' . $model->imageFile->extension);
                        $model->ip_image_id = $img_guid;

                        Yii::$app->session->setFlash('success','New image uploaded Successfully.');

                        $m_bucketName = "gcbimages";
                        $bucket_folder = 'segmentation_images';
                        $bucket_file_name = $path . $img_guid . '.' . $model->imageFile->extension;
                        $STORAGE_KEYFILE = Yii::getAlias('@common')."/GC/ConcatLogsBigQuery-09867ccb4236.json";
                        $CLOUD_PROJECTID = "concatlogsbigquery";
                        $AUTH_WEB = (array)json_decode(file_get_contents($STORAGE_KEYFILE));   
                        $file = fopen($bucket_file_name, 'r');
                        $objectName = $bucket_folder."/".$img_guid . '.' . $model->imageFile->extension;
                        $storage = new StorageClient(['projectId' => $CLOUD_PROJECTID, 'keyFile' => $AUTH_WEB, true]);
                        $bucket = $storage->bucket($m_bucketName);
                        $object = $bucket->upload($file, ['name' => $objectName]);
                        $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
                        $json_array = array('name' => $objectName ,'gs_url' => "gs://{$m_bucketName}/{$objectName}",'public_url' => "https://{$m_bucketName}.storage.googleapis.com/{$objectName}");
                        $targetUrl = $json_array['public_url'];
                        
                        $post_array = array('image_id'  =>  $img_guid, 
                                            'image_url'  =>  "https://{$m_bucketName}.storage.googleapis.com/{$objectName}");
                            $IDSIP = commonComponent::ipAddressIDsActive();
                            $IDSIP = '35.224.35.208';
                            if(!empty($IDSIP)){
                                $SERVICE_URL = "http://{$IDSIP}/rest/singleimagedetection/";
                                $returnData = $this->PostServiceIDS($SERVICE_URL, $post_array);
                                $returnRes = json_decode($returnData);
                                var_dump($returnData);exit;
                                if($returnRes['error'] == '200')
                                    $model->ip_posted_flag = 1;
                                else{
                                    $model->ip_error_flag = 1;
                                    $model->ip_error_message = $returnRes['message'];
                                }
                            }

                        $model->ip_image_url = $targetUrl;
                        $model->save(false);
                        unlink($path . $img_guid . '.' . $model->imageFile->extension);
                    /*
                    $STORAGE_CLIENTID = "concat-storage-admin.apps.googleusercontent.com";
                    $STORAGE_SERVICE_ACCOUNT = "concat-storage-admin@concatlogsbigquery.iam.gserviceaccount.com";
                    $STORAGE_KEYFILE = Yii::getAlias('@common')."/GC/ConcatLogsBigQuery-6f06ebde7445.p12";
                    $STORAGE_BUCKET = "gcbimages";
                    $bucket_folder = 'segmentation_images';
                    $bucket_file_name = $path . $img_guid . '.' . $model->imageFile->extension;

                    $pgcf = new ProcessGCFiles();
                    $pgcf->client_id = $STORAGE_CLIENTID;
                    $pgcf->service_account_name = $STORAGE_SERVICE_ACCOUNT;
                    $pgcf->key_file_location = $STORAGE_KEYFILE;
                    $pgcf->bucketName = $STORAGE_BUCKET;
                    $pgcf->m_full_url_prefix = "http://{$pgcf->bucketName}.storage.googleapis.com/";
                    $pgcf->Setup();
                    $bucket_public_url = $pgcf->UploadFile($bucket_folder, $bucket_file_name);
echo $bucket_public_url;
*/
                        return $this->redirect(['index']);
                    }
                }
            }
            else if($model->uploadType==2){
                $model->ip_image_id = $img_guid;
                $model->save(false);
                Yii::$app->session->setFlash('success','New image uploaded Successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ImageProcessing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ip_job_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ImageProcessing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImageProcessing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImageProcessing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImageProcessingList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
