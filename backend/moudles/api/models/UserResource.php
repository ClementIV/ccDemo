<?php
namespace backend\moudles;
use yii\base\Model;
use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
class UserResource extends Model implements Linkable
{
    public $id;
    public $email;

    //...
    public function fields()
    {
        return ['id','email'];
    }
    // public function extraFields()
    // {
    //     return
    // }
    public 


}
?>
