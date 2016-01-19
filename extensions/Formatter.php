<?php

namespace app\extensions;

use app\models\Ad;
use app\models\BankAccount;
use app\models\Feedback;
use app\models\FileUploadConfig;
use app\models\FriendlyLink;
use app\models\GroupOption;
use app\models\IpAccessRule;
use app\models\Lookup;
use app\models\Meta;
use app\models\Option;
use app\models\User;
use app\models\Video;
use app\models\WorkflowTask;
use Yii;
use yii\helpers\Html;

class Formatter extends \yii\i18n\Formatter
{

    // Common
    public function asBoolean($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }

        return '<span class="glyphicon glyphicon-' . ($value ? 'ok' : 'remove') . '"></span>';
    }

    /**
     * 图片展示
     * @param string $value
     * @param array $options
     * @return string
     */
    public function asImage($value, $options = [])
    {
        return empty($value) ? $this->nullDisplay : Html::img(Yii::$app->getRequest()->getBaseUrl() . $value, $options);
    }

    /**
     * 下载按钮
     * @param string $value
     * @return string
     */
    public function asDownload($value)
    {
        if (empty($value)) {
            return $this->nullDisplay;
        } else {
            return Html::a(Yii::t('app', 'Download'), $value, ['target' => '_blank', 'class' => 'btn-download']);
        }
    }

    /**
     * 获取分组名称
     * @param string $groupName
     * @param string $value
     * @return mixed
     */
    public function asGroupName($groupName, $value)
    {
        if ($value == 0) {
            return $this->nullDisplay;
        } else {
            return GroupOption::getText($groupName, $value);
        }
    }

    /**
     * Get data status text view
     * @param integer $value
     * @return mixed
     */
    public function asDataStatus($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $options = Option::statusOptions();
        return isset($options[$value]) ? $options[$value] : $this->nullDisplay;
    }

    /**
     * Get model name text view
     * @param integer $value
     * @return mixed
     */
    public function asModelName($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $options = isset(Yii::$app->params['contentModules']) ? Yii::$app->params['contentModules'] : [];
        return isset($options[$value]['label']) ? Yii::t('app', $options[$value]['label']) : $value;
    }

    // IP Access Rule
    public function asIpAccessRuleType($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $options = IpAccessRule::typeOptions();
        return isset($options[$value]) ? $options[$value] : $this->nullDisplay;
    }

    // User
    public function asUserType($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $options = User::typeOptions();
        return isset($options[$value]) ? $options[$value] : $this->nullDisplay;
    }

    public function asUserStatus($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $options = User::statusOptions();
        return isset($options[$value]) ? $options[$value] : $this->nullDisplay;
    }

    public function asUserRole($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $options = User::roleOptions();
        return isset($options[$value]) ? $options[$value] : $this->nullDisplay;
    }

    // Lookup
    /**
     * 返回类型
     * @param integer $value
     * @return mixed
     */
    public function asLookupReturnType($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }

        $options = Lookup::returnTypeOptions();
        return isset($options[$value]) ? $options[$value] : $this->nullDisplay;
    }

}
