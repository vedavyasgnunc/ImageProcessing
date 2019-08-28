<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 

class commonComponent extends Component {
    
    /*
     * This is the function with alogorithm logic to generate the Authentication unique FK key
     */
    public static function authFkey()
    {
        $ret_guid = "";
        $guid = strtoupper(md5(uniqid(rand(), true)));
        $guid_split = preg_split('//', $guid, -1, PREG_SPLIT_NO_EMPTY);
        for ($i = 0; $i < count($guid_split); $i++)
            if ($i == 7 || $i == 11 || $i == 15 || $i == 19)
                $ret_guid .= $guid_split[$i]."-";
            else
                $ret_guid .= $guid_split[$i];
        return $ret_guid;
    }
    
    
    /**
     * Function to fetch Id based on the Authentication unique FK key
     * @param type $querycond
     * $querycond is the sql statement
     * @return results of the sql statement
     */
    public static function getIdFromFK($querycond){
        $connection = Yii::$app->getDb();
        $data = $connection->createCommand("$querycond")->queryAll();

        return $data[0];
    }
    
    /**
     * Function to fetch all results from query
     * @return results of the sql statement
     * @param type $query
     * @param type $restrictRes
     * @return type
     */
    public static function getQueryResults($query,$restrictRes=NULL)
    {
        $connection = Yii::$app->getDb();
        $data = $connection->createCommand("$query")->queryAll();
        if(!empty($data[0])){
            if($restrictRes==NULL)
                return $data[0];
            else
                return $data;
        }
        else
            return array();
    }
    
    /**
     * Function to execute the query
     * @param type $query
     * @return type
     */
    public static function executeQuery($query)
    {
        $connection = Yii::$app->getDb();
        $data = $connection->createCommand("$query")->execute();
        return $data;
    }
    
    //execute queries and return data
    public function welcome()
    {
        echo "Hello..Welcome to MyComponent";
    }
}
