<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "{{%cc_course}}".
 *
 * @property integer $CID
 * @property string $CourseName
 * @property integer $Type
 * @property string $CourseCode
 * @property string $EnglishName
 * @property string $Brief
 * @property string $Introduction
 * @property string $Books
 * @property boolean $Status
 * @property integer $Credits
 * @property string $Remark
 *
 * @property CcEducationLevel $type
 * @property CcLesson[] $ccLessons
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CourseName'], 'required'],
            [['Type', 'Credits'], 'integer'],
            [['Brief', 'Introduction', 'Books'], 'string'],
            [['Status'], 'boolean'],
            [['CourseName', 'CourseCode', 'EnglishName', 'Remark'], 'string', 'max' => 255],
            [['Type'], 'exist', 'skipOnError' => true, 'targetClass' => CcEducationLevel::className(), 'targetAttribute' => ['Type' => 'ELID']],
        ];
    }
    public function fields()
    {
        return ['CID','CourseName','Type'];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CID' => Yii::t('app', '课程标识ID'),
            'CourseName' => Yii::t('app', '课程名称'),
            'Type' => Yii::t('app', '课程的类型(本科，硕士，博士，硕博连读等)'),
            'CourseCode' => Yii::t('app', '学校课程标号(课程代码)'),
            'EnglishName' => Yii::t('app', '课程英文名'),
            'Brief' => Yii::t('app', '课程教学大纲'),
            'Introduction' => Yii::t('app', '课程主要内容简介'),
            'Books' => Yii::t('app', '课程使用教材(参考教材)'),
            'Status' => Yii::t('app', '课程状态(是否是现在还在开课 1:现在开课 2：已经没有该课)'),
            'Credits' => Yii::t('app', '学分'),
            'Remark' => Yii::t('app', '一些备注'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CcEducationLevel::className(), ['ELID' => 'Type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcLessons()
    {
        return $this->hasMany(CcLesson::className(), ['CourseID' => 'CID']);
    }
}
