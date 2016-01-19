<?php

namespace app\models;

use yadjet\helpers\DatetimeHelper;
use Yii;

/**
 * This is the model class for table "{{%ip_access_rule}}".
 *
 * @property integer $id
 * @property string $ip_address
 * @property integer $final_date
 * @property integer $type
 * @property integer $enabled
 * @property integer $tenant_id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property integer $deleted_at
 */
class IpAccessRule extends BaseActiveRecord
{

    /**
     * Type values
     */
    const TYPE_DENY = 0;
    const TYPE_ALLOW = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ip_access_rule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip_address', 'type', 'enabled'], 'required'],
            [['ip_address'], 'trim'],
            ['ip_address', 'match', 'pattern' => '/^[1-9].*[0-9.\*\/-]+$/',
                'message' => '有效的字符为数字、“.”、“/”、“-”、“*”组成的 IP 或者 IP 段。'],
            ['ip_address', 'checkWholeIP', 'on' => 'checkWholeIP'],
            ['ip_address', 'unique', 'targetAttribute' => ['ip_address', 'tenant_id']],
            ['final_date', 'date'],
            ['enabled', 'default', 'value' => 0],
            ['enabled', 'boolean'],
            [['type', 'tenant_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'], 'integer'],
            [['ip_address'], 'string', 'max' => 255]
        ];
    }

    /**
     * 检测是否为有效的 IP 地址
     * @param string $attribute
     * @param array $params
     */
    public function checkWholeIP($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!filter_var($this->$attribute, FILTER_VALIDATE_IP)) {
                $this->addError($attribute, 'IP 地址无效');
            }
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['checkWholeIP'] = ['ip_address'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'ip_address' => Yii::t('app', 'IP Address'),
            'final_date' => Yii::t('ipAccessRule', 'Final Date'),
            'type' => Yii::t('ipAccessRule', 'Type'),
        ]);
    }

    /**
     * Return IP Access Rule type
     * @return array
     */
    public static function typeOptions()
    {
        return [
            self::TYPE_DENY => Yii::t('ipAccessRule', 'Deny'),
            self::TYPE_ALLOW => Yii::t('ipAccessRule', 'Allow'),
        ];
    }

    // Events
    public function afterFind()
    {
        parent::afterFind();
        $this->final_date = date('Y-m-d', $this->final_date);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (strpos($this->ip_address, '*') === false && strpos($this->ip_address, '/') === false && strpos($this->ip_address, '-') === false) {
                $this->scenario = 'checkWholeIP';
            }

            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->final_date = DatetimeHelper::mktime($this->final_date);

            return true;
        } else {
            return false;
        }
    }

}
