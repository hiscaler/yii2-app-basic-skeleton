<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%lookup}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $description
 * @property string $value
 * @property string $return_type
 * @property integer $enabled
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property integer $deleted_at
 */
class Lookup extends BaseActiveRecord
{

    /**
     * Return types
     */
    const RETURN_TYPE_INTEGER = 0;
    const RETURN_TYPE_STRING = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'value', 'return_type', 'enabled'], 'required'],
            [['label', 'value', 'description'], 'trim'],
            ['label', 'match', 'pattern' => '/^[a-z][a-z.]+$/'],
            ['label', 'unique'],
            [['value'], 'string'],
            ['enabled', 'default', 'value' => 0],
            ['enabled', 'boolean'],
            [['enabled', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'], 'integer'],
            [['label', 'description', 'return_type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'label' => Yii::t('lookup', 'Label'),
            'description' => Yii::t('lookup', 'Description'),
            'value' => Yii::t('lookup', 'Value'),
            'return_type' => Yii::t('lookup', 'Return Type'),
        ]);
    }

    public static function returnTypeOptions()
    {
        return [
            self::RETURN_TYPE_INTEGER => Yii::t('lookup', 'Integer'),
            self::RETURN_TYPE_STRING => Yii::t('lookup', 'String'),
        ];
    }

    /**
     * 根据设定的标签获取值
     * @param string $label
     * @param string $defaultValue
     * @return mixed
     */
    public static function getValue($label, $defaultValue = null)
    {
        $rawData = Yii::$app->db->createCommand('SELECT [[value]], [[return_type]] FROM ' . static::tableName() . ' WHERE [[label]] = :label AND [[enabled]] = :enabled')->bindValues([
                ':label' => strtoupper(trim($label)),
                ':enabled' => Constant::BOOLEAN_TRUE
            ])->queryOne();
        if ($rawData === false) {
            $value = $defaultValue;
        } else {
            $value = $rawData['value'];
            switch ($rawData['return_type']) {
                case self::RETURN_TYPE_INTEGER:
                    $value = (int) $value;
                    break;
                case self::RETURN_TYPE_STRING:
                    $value = (string) $value;
                    break;
            }
        }

        return $value;
    }

}
