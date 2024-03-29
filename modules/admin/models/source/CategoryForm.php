<?php

namespace app\modules\admin\models\source;

use app\models\event\main\EventCategory;

/**
 * Description of CityForm
 *
 * @author Granik
 */
class CategoryForm extends EventCategory
{


    public function rules()
    {
        return [
            ['name', 'string', 'min' => 2, 'max' => 30],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => EventCategory::className(),
                'message' => 'Такая категория уже существует!',
                'filter' => ['<>', 'id', $this->id ?? 0]
            ],
            ['color', 'string', 'min' => 7, 'max' => 7]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название категории',
            'color' => 'Цвет в таблице'
        ];
    }

    public function createNew()
    {
        if (!$this->validate()) {
            throw new ErrorException("Ошибка валидации данных!");
        }
        $deleted = $this->find()->where(['name' => 'removed-' . trim($this->name)])->one();
        if (!empty($deleted)) {
            //если уже есть такая, но удалена
            $deleted->name = str_replace('removed-', '', $deleted->name);
            $deleted->is_deleted = 0;
            return $deleted->save() ? true : false;
        }

        return $this->save() ? true : false;
    }
}