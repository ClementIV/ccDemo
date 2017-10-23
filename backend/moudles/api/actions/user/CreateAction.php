<?php
namespace backend\moudles\api\actions\user;

use yii\rest\Action;
use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;
/**
 * CreateAction implements the API endpoint for creating a new model from the given data.
 * This Action for create a new user
 *

 */
class CreateAction extends Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario =Model::SCENARIO_DEFAULT;

    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */

    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess,$this->id);
        }
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]
        );
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if($model->validate()){
            $model->save();
            $modelClass=$this->modelClass;
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            // print_r($id);
            return  $modelClass::findOne($id);

        };
    }

}

?>
