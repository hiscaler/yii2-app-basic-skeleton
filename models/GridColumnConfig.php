<?php

namespace app\models;

use app\models\Yad;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%grid_column_config}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $attribute
 * @property string $css_class
 * @property string $css_style
 * @property integer $visible
 * @property integer $user_id
 */
class GridColumnConfig extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%grid_column_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'attribute'], 'required'],
            [['user_id'], 'integer'],
            [['visible'], 'boolean'],
            [['name', 'attribute', 'css_class', 'css_style'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('gridColumnConfig', 'Name'),
            'attribute' => Yii::t('gridColumnConfig', 'Attribute'),
            'css_class' => Yii::t('gridColumnConfig', 'CSS Class'),
            'css_style' => Yii::t('gridColumnConfig', 'CSS Style'),
            'visible' => Yii::t('gridColumnConfig', 'Visible'),
        ];
    }

    /**
     * 获取指定表格（Grid View）的配置数据
     * @todo 数据应该缓存起来
     * @param string $name
     * @return array
     */
    public static function getConfigs($name, $visibleColumn = null)
    {
        $sql = 'SELECT [[name]], [[attribute]], [[css_class]], [[css_style]], [[visible]] FROM {{%grid_column_config}} WHERE [[tenant_id]] = :tenantId AND [[user_id]] = :userId AND [[name]] = :name';
        $bindValues = [
            ':tenantId' => Yad::getTenantId(),
            ':userId' => Yii::$app->user->id,
            ':name' => $name,
        ];
        if ($visibleColumn !== null) {
            $sql .= ' AND [[visible]] = :visible';
            $bindValues[':visible'] = $visibleColumn ? Constant::BOOLEAN_TRUE : Constant::BOOLEAN_FALSE;
        }

        return Yii::$app->db->createCommand($sql)->bindValues($bindValues)->queryAll();
    }

    /**
     * 获取设置为不可见的列
     * @return array
     */
    public static function getInvisibleColumns($name)
    {
        return Yii::$app->db->createCommand('SELECT [[attribute]] FROM {{%grid_column_config}} WHERE [[tenant_id]] = :tenantId AND [[user_id]] = :userId AND [[name]] = :name AND [[visible]] = :visible')->bindValues([
                ':tenantId' => Yad::getTenantId(),
                ':userId' => Yii::$app->user->id,
                ':name' => $name,
                ':visible' => Constant::BOOLEAN_FALSE
            ])->queryColumn();
    }

    // Events
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->user_id = Yii::$app->user->id;
            }

            return true;
        } else {
            return false;
        }
    }

}
