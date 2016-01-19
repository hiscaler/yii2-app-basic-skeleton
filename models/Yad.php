<?php

namespace app\models;

use Yii;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class Yad
{

    public static function getLanguages()
    {
        return [
            'ar' => Yii::t('language', 'ar'),
            'bg' => Yii::t('language', 'bg'),
            'ca' => Yii::t('language', 'ca'),
            'da' => Yii::t('language', 'da'),
            'de' => Yii::t('language', 'de'),
            'en-US' => Yii::t('language', 'en-US'),
            'el' => Yii::t('language', 'el'),
            'es' => Yii::t('language', 'es'),
            'et' => Yii::t('language', 'et'),
            'fa-IR' => Yii::t('language', 'fa-IR'),
            'fi' => Yii::t('language', 'fi'),
            'fr' => Yii::t('language', 'fr'),
            'hu' => Yii::t('language', 'hu'),
            'id' => Yii::t('language', 'id'),
            'it' => Yii::t('language', 'it'),
            'ja' => Yii::t('language', 'ja'),
            'kk' => Yii::t('language', 'kk'),
            'ko' => Yii::t('language', 'ko'),
            'lt' => Yii::t('language', 'lt'),
            'lv' => Yii::t('language', 'lv'),
            'nl' => Yii::t('language', 'nl'),
            'pl' => Yii::t('language', 'pl'),
            'pt-BR' => Yii::t('language', 'pt-BR'),
            'pt-PT' => Yii::t('language', 'pt-PT'),
            'ro' => Yii::t('language', 'ro'),
            'ru' => Yii::t('language', 'ru'),
            'sk' => Yii::t('language', 'sk'),
            'sr' => Yii::t('language', 'sr'),
            'sr-Latn' => Yii::t('language', 'sr-Latn'),
            'th' => Yii::t('language', 'th'),
            'uk' => Yii::t('language', 'uk'),
            'vi' => Yii::t('language', 'vi'),
            'zh-CN' => Yii::t('language', 'zh-CN'),
            'zh-TW' => Yii::t('language', 'zh-TW')
        ];
    }

    /**
     * 时区列表
     * @return array
     */
    public static function getTimezones()
    {
        return [
            'Etc/GMT' => Yii::t('timezone', 'Etc/GMT'),
            'Etc/GMT+0' => Yii::t('timezone', 'Etc/GMT+0'),
            'Etc/GMT+1' => Yii::t('timezone', 'Etc/GMT+1'),
            'Etc/GMT+10' => Yii::t('timezone', 'Etc/GMT+10'),
            'Etc/GMT+11' => Yii::t('timezone', 'Etc/GMT+11'),
            'Etc/GMT+12' => Yii::t('timezone', 'Etc/GMT+12'),
            'Etc/GMT+2' => Yii::t('timezone', 'Etc/GMT+2'),
            'Etc/GMT+3' => Yii::t('timezone', 'Etc/GMT+3'),
            'Etc/GMT+4' => Yii::t('timezone', 'Etc/GMT+4'),
            'Etc/GMT+5' => Yii::t('timezone', 'Etc/GMT+5'),
            'Etc/GMT+6' => Yii::t('timezone', 'Etc/GMT+6'),
            'Etc/GMT+7' => Yii::t('timezone', 'Etc/GMT+7'),
            'Etc/GMT+8' => Yii::t('timezone', 'Etc/GMT+8'),
            'Etc/GMT+9' => Yii::t('timezone', 'Etc/GMT+9'),
            'Etc/UTC' => Yii::t('timezone', 'Etc/UTC'),
            'PRC' => Yii::t('timezone', 'PRC'),
        ];
    }

    /**
     * 设置租赁站点信息
     * @param integer $tenantId
     * @return boolean
     */
    public static function setTenantData($tenantId)
    {
        $db = Yii::$app->db;
        $tenantUserRole = $db->createCommand('SELECT [[role]] FROM {{%tenant_user}} WHERE [[tenant_id]] = :tenantId AND [[user_id]] = :userId AND [[enabled]] = :enabled')->bindValues([
                ':tenantId' => (int) $tenantId,
                ':userId' => Yii::$app->user->id,
                ':enabled' => Constant::BOOLEAN_TRUE
            ])->queryScalar();
        if ($tenantUserRole !== false) {
            $tenant = $db->createCommand('SELECT [[id]], [[name]], [[language]], [[timezone]], [[date_format]], [[time_format]], [[datetime_format]], [[domain_name]] FROM {{%tenant}} WHERE [[id]] = :id AND [[enabled]] = :enabled')->bindValues([
                    ':id' => (int) $tenantId,
                    ':enabled' => Constant::BOOLEAN_TRUE
                ])->queryOne();
            if ($tenant) {
                $session = Yii::$app->getSession();
                $session->set('tenant.id', $tenant['id']);
                $session->set('tenant.name', $tenant['name']);
                $session->set('tenant.language', $tenant['language']);
                $session->set('tenant.timezone', $tenant['timezone']);
                $session->set('tenant.dateFormat', $tenant['date_format']);
                $session->set('tenant.timeFormat', $tenant['time_format']);
                $session->set('tenant.datetimeFormat', $tenant['datetime_format']);
                $session->set('tenant.domainName', $tenant['domain_name']);
                $session->set('tenant.role', $tenantUserRole); // 站点管理角色

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get current language
     */
    public static function getLanguage()
    {
        return Yii::$app->getSession()->get('tenant.language', Yii::$app->language);
    }

    public static function getTimezone()
    {
        return Yii::$app->getSession()->get('tenant.timezone', Yii::$app->timeZone);
    }

    public static function getTenantId()
    {
        return Yii::$app->getSession()->get('tenant.id', 0);
    }

    public static function getTenantName()
    {
        return Yii::$app->getSession()->get('tenant.name');
    }

    /**
     * 用户角色
     * @return mixed
     */
    public static function getUserRole()
    {
        return Yii::$app->getSession()->get('user.role');
    }

    /**
     * 租赁站点的用户角色
     * @return mixed
     */
    public static function getTenantUserRole()
    {
        return Yii::$app->getSession()->get('tenant.role');
    }

    /**
     * Return table name by special model name
     * For Example: Yad::modelName2TableName('app\models\news') return `news`, if
     * Use table prefix, will return `table_prifix_news` name
     * @param string $modelName
     * @return string
     */
    public static function modelName2TableName($modelName)
    {
        $tableName = null;
        if (!empty($modelName)) {
            $tableName = (Yii::$app->getDb()->tablePrefix ? : '') . Inflector::camel2id(StringHelper::basename(BaseActiveRecord::id2ClassName($modelName)), '_');
        }

        return $tableName;
    }

    /**
     * 获取文本内容中的所有图片路径
     * @param string $content
     * @param string|integer $order
     * @return array|string|null
     */
    public static function getTextImages($content, $order = 'ALL')
    {
        $images = null;
        if (!empty($content)) {
            $pattern = "/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
            preg_match_all($pattern, $content, $match);
            if (isset($match[1]) && !empty($match[1])) {
                if ($order === 'ALL') {
                    $images = $match[1];
                }
                if (is_numeric($order) && isset($match[1][$order - 1])) {
                    $images = $match[1][$order - 1];
                }
            }
        }

        return $images;
    }

}
