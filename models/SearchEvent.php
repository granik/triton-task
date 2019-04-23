<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;
use app\models\City;
use app\components\Functions;

/**
 * searchCity represents the model behind the search form of `app\models\City`.
 */
class SearchEvent extends Event
{
    
    public $type_id;
    public $category_id;
    //configuration
    public $config;
    /**
     * {@inheritdoc}
     */
    
    public function __construct(array $config = ['is_archive' => false]) {
        $this->config = $config;
        parent::__construct();
    }
    
    public function rules()
    {
        return [
            [['type', 'city', 'date', 'category', 'type_id', 'category_id'], 'safe'],
            ['date', 'date', 'format' => 'mm.dd.yyyy']
        ];
    }
    
    public function attributeLabels() {
        return [
            'type_id' => 'Тип события',
            'city' => 'Город',
            'category_id' => 'Категория'
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
        if($this->config['is_archive']) {
            $query = Event::find()
                ->with(['type', 'city', 'category'])
                ->where("event.date < NOW() OR is_cancel = 1")
                ->orderBy(['date' => SORT_DESC]);
        } else {
            $query = Event::find()
                ->with(['type', 'city', 'category'])
                ->where("event.date >= NOW() AND is_cancel = 0")
                ->orderBy(['date' => SORT_DESC]);
        }
        
        

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
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'date' => Functions::toDBdate($this->date)
        ]);
        $query->andFilterWhere([
            'event.is_deleted' => 0
        ]);
       

        
        $query->joinWith('city');
        $query->andFilterWhere(['like', 'city.name', $this->city]);


        return $dataProvider;
    }
}