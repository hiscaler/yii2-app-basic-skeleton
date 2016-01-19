<?php

namespace app\models;

use app\models\IpAccessRule;
use yii\data\ActiveDataProvider;

/**
 * IpAccessRuleSearch represents the model behind the search form about `app\models\IpAccessRule`.
 */
class IpAccessRuleSearch extends IpAccessRule
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'enabled'], 'integer'],
            [['ip_address'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return parent::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = IpAccessRule::find()->with(['creater', 'updater', 'deleter'])->asArray(true);
        $query->andWhere('tenant_id = :tenantId', [':tenantId' => Yad::getTenantId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'type' => $this->type,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }

}
