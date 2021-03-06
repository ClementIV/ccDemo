<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\Cors;
use yii\filters\ContentNegotiator;
use yii\web\Response;
class CourseController extends ActiveController
{
    public $modelClass = 'backend\modules\api\models\Course';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
       'class' => \yii\filters\Cors::className(),
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index'  => ['get'],
                'view'   => ['get','options'],
                'create' => ['post'],
            ]
        ];
       // re-add authentication filter
       $behaviors['authenticator'] = $auth;
       // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
       $behaviors['authenticator']['except'] = ['options'];
       $behaviors['contentNegotiator']=[
           'class' =>ContentNegotiator::className(),
           'formats' => [
               'application/json' =>Response::FORMAT_JSON
           ]
       ];
       return $behaviors;
        // return [
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'index'  => ['get'],
        //             'view'   => ['get','options'],
        //             'create' => ['post'],
        //         ]
        //     ],
        //     'corsFilter' => [
        //         'class' => Cors::className(),
        //     //     'cors'=>[
        //     //         'Access-Control-Request-Method' =>['*'],
        //     //         'Access-Control-Resquest-Header' => ['*'],
        //     //         'Access-Control-Request-Credentials' => true,
        //     //         // Allow OPTIONS caching
        //        //
        //     //    'Access-Control-Max-Age' => 3600,
        //        //
        //     //    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
        //        //
        //     //    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
        //     //     ]
        //     ],
        //     'contentNegotiator'=>[
        //         'class' =>ContentNegotiator::className(),
        //         'formats' => [
        //             'application/json' =>Response::FORMAT_JSON
        //         ]
        //     ]
        //
        // ];
    }
}
?>
