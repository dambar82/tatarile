<?php

namespace app\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\backend\models\Entity;

/**
 * EntitySearch represents the model behind the search form about `app\backend\models\Entity`.
 */
class EntitySearch extends Entity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_create', 'date_update', 'status', 'user'], 'integer'],
            [['title'], 'string'],
            [['corrector'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Entity::find();

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

            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'status' => $this->status,
            'user' => $this->user,
            'entity_type_id'=>$this->entity_type_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->orderBy('title',SORT_ASC);

        return $dataProvider;
    }

    public function searchall($params)
    {
        $query = Entity::find();

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

            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'status' => $this->status,
            'user' => $this->user,
            'entity_type_id'=>$this->entity_type_id,
            'ready' => 0
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->orderBy('title',SORT_ASC);

        return $dataProvider;
    }

    public function search_success($params)
    {
        $query = Entity::find();

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

            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'status' => $this->status,
            'user' => $this->user,
            'entity_type_id'=>$this->entity_type_id,
            'ready' => 1
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->orderBy('title',SORT_ASC);

        return $dataProvider;
    }
}
