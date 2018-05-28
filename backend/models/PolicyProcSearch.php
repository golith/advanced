<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PolicyProc;

/**
 * PolicyProcSearch represents the model behind the search form of `backend\models\PolicyProc`.
 */
class PolicyProcSearch extends PolicyProc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proc_step', 'policy_id'], 'integer'],
            [['proc_text'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = PolicyProc::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'proc_step' => $this->proc_step,
            'policy_id' => $this->policy_id,
        ]);

        $query->andFilterWhere(['like', 'proc_text', $this->proc_text]);

        return $dataProvider;
    }
}
