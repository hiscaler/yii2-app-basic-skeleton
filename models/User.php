<?php

namespace app\models;

use app\models\BaseUser;
use app\models\Option;
use app\models\Yad;
use PDO;
use Yii;

/**
 * User model
 *
 * @property integer $id
 * @property integer $type
 * @property string $username
 * @property string $nickname
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property string $register_ip
 * @property integer $login_count
 * @property string $last_login_ip
 * @property integer $last_login_time
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $deleted_at
 * @property integer $deleted_by
 * @property string $password write-only password
 */
class User extends BaseUser
{

    /**
     * User types
     */
    const TYPE_BACKEND = 1;
    const TYPE_app = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['username', 'match', 'pattern' => '/^[a-z0-9]+$/'],
            [['username', 'nickname', 'password_hash', 'email'], 'trim'],
            [['username'], 'string', 'min' => 5, 'max' => 12],
            [['username', 'nickname', 'email'], 'trim'],
            ['email', 'email'],
            [['username', 'email'], 'unique'],
            ['type', 'default', 'value' => self::TYPE_BACKEND],
            ['type', 'in', 'range' => array_keys(self::typeOptions())],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => array_keys(self::statusOptions())],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => array_keys(self::roleOptions())],
            [['register_ip', 'last_login_ip', 'last_login_time', 'login_count'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'type' => Yii::t('user', 'Type'),
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'confirm_password' => Yii::t('user', 'Confirm Password'),
            'nickname' => Yii::t('user', 'Nickname'),
            'email' => Yii::t('user', 'Email'),
            'role' => Yii::t('user', 'Role'),
            'register_ip' => Yii::t('user', 'Register IP'),
            'login_count' => Yii::t('user', 'Login Count'),
            'last_login_time' => Yii::t('user', 'Last Login Time'),
            'last_login_ip' => Yii::t('user', 'Last Login IP'),
        ]);
    }

    /**
     * Return user type options
     * @return array
     */
    public static function typeOptions()
    {
        $options = [self::TYPE_BACKEND => Yii::t('user', 'Backend User')];
        if (isset(Yii::$app->params['enableappUser']) && Yii::$app->params['enableappUser']) {
            $options[self::TYPE_app] = Yii::t('user', 'app User');
        }

        return $options;
    }

    // Events
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                if ($this->type === null) {
                    $this->type = static::TYPE_app;
                }
            }

            if (empty($this->nickname)) {
                $this->nickname = $this->username;
            }

            return true;
        } else {
            return false;
        }
    }

}
