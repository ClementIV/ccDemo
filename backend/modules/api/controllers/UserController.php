<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\VerbFilter;
class UserController extends ActiveController
{
    public $modelClass = 'backend\modules\api\models\User';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['get'],
                    'view'   => ['get'],
                    'create' => ['post'],
                ]
            ],

        ];
    }
    public function actions()
   {
       return [
           'index' => [
               'class' => 'yii\rest\IndexAction',
               'modelClass' => $this->modelClass,
               'checkAccess' => [$this, 'checkAccess'],
           ],
           'view' => [
               'class' => 'backend\modules\api\actions\user\ViewAction',
               'modelClass' => $this->modelClass,
            //    'checkAccess' => [$this, 'checkAccess'],
           ],
           'create' => [
               'class' => 'backend\modules\api\actions\user\CreateAction',
               'modelClass' => $this->modelClass,
               'checkAccess' => [$this, 'checkAccess'],
               'scenario' => $this->createScenario,
           ],
           'update' => [
               'class' => 'yii\rest\UpdateAction',
               'modelClass' => $this->modelClass,
               'checkAccess' => [$this, 'checkAccess'],
               'scenario' => $this->updateScenario,
           ],
           'delete' => [
               'class' => 'yii\rest\DeleteAction',
               'modelClass' => $this->modelClass,
               'checkAccess' => [$this, 'checkAccess'],
           ],
           'options' => [
               'class' => 'yii\rest\OptionsAction',
           ],
       ];
   }
    public function actionView($id)
    {

        return User::findAll();
    }
    // public function create($param)
    // {
    //     // $model
    // }
    public function  actionCreate($params)
    {
        $model = new User();
        //$model->username = Yii::$app->request->post()->username;
        return $model->findAll();
        // if($model->load(Yii::$app->request->post())){
        //
        //
        // }
    }
    public function actionIndex()
    {
        return User::findAll();
    }
}
