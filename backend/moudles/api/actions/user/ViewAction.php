<?php
namespace backend\moudles\api\actions\user;

use yii\rest\Action;
use Yii;
use yii\data\ActiveDataProvider;
class ViewAction extends Action
{
    public function run($id)
    {
        $model = $this->findModel($id);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        return $model;
    }
}
?>
