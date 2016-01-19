<?php

namespace app\models;

use yadjet\helpers\StringHelper;
use yadjet\helpers\UtilHelper;
use Yii;
use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * @property string $keywords
 * @property string $entityAttributes
 * @property string $entityNodeIds
 * @property string $entityNodeNames
 * @property integer $isDraft
 * @property integer $tenant_id
 */
class BaseActiveRecord extends ActiveRecord
{

    /**
     * 默认排序值
     */
    const DEFAULT_ORDERING_VALUE = 10000;

    /**
     * `app\model\Post` To `app-model-Post`
     * @param string $className
     * @return string
     */
    public static function className2Id($className = null)
    {
        if ($className === null) {
            $className = static::className();
        }
        return str_replace('\\', '-', $className);
    }

    /**
     * `app-model-Post` To `app\model\Post`
     * @param string $id
     * @return string
     */
    public static function id2ClassName($id)
    {
        return str_replace('-', '\\', $id);
    }

    private function normalizeWords($value)
    {
        if (!empty($value)) {
            $value = UtilHelper::array2string(array_unique(UtilHelper::string2array(StringHelper::makeSemiangle($value))));
        }

        return $value;
    }

    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute, $params)
    {
        if (!empty($this->tags)) {
            $this->tags = $this->normalizeWords($this->tags);
        }
    }

    /**
     * Normalizes the user-entered keywords.
     */
    public function normalizeKeywords($attribute, $params)
    {
        if (!empty($this->keywords)) {
            $this->keywords = $this->normalizeWords($this->keywords);
        }
    }

    /**
     * Creater relational
     * @return ActiveQueryInterface the relational query object.
     */
    public function getCreater()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->select(['id', 'nickname']);
    }

    /**
     * Updater relational
     * @return ActiveQueryInterface the relational query object.
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->select(['id', 'nickname']);
    }

    /**
     * Deleter relational
     * @return ActiveQueryInterface the relational query object.
     */
    public function getDeleter()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by'])->select(['id', 'nickname']);
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'id' => Yii::t('app', 'ID'),
            'tags' => Yii::t('app', 'Tags'),
            'alias' => Yii::t('app', 'Alias'),
            'ordering' => Yii::t('app', 'Ordering'),
            'node_id' => Yii::t('app', 'Node'),
            'group_id' => Yii::t('app', 'Group'),
            'keywords' => Yii::t('app', 'Page Keywords'),
            'description' => Yii::t('app', 'Page Description'),
            'content' => Yii::t('app', 'Content'),
            'picture_path' => Yii::t('app', 'Picture'),
            'hits_count' => Yii::t('app', 'Hits Count'),
            'status' => Yii::t('app', 'Status'),
            'enabled' => Yii::t('app', 'Enabled'),
            'created_by' => Yii::t('app', 'Created By'),
            'creater.nickname' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updater.nickname' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    // Events
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {


                $this->created_by = Yii::$app->user->id ? : 0;
                $this->created_at = time();
                if ($this->hasAttribute('updated_at')) {
                    $this->updated_by = $this->created_by;
                    $this->updated_at = $this->created_at;
                }
            } else {
                if ($this->hasAttribute('updated_at')) {
                    $this->updated_by = Yii::$app->user->id;
                    $this->updated_at = time();
                }
            }

            return true;
        } else {
            return false;
        }
    }

}
