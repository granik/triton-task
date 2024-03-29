<?php

namespace app\modules\admin\models\fields;

use app\models\event\logistics\LogisticFields;

/**
 * Description of LogisticForm
 *
 * @author Granik
 */
class LogisticForm extends LogisticFields
{

    public function rules()
    {
        return [
            ['name', 'string', 'min' => 3, 'max' => 20],
            ['name', 'required'],
            ['name', 'trim'],
            ['name', 'unique', 'targetClass' => LogisticFields::className(),
                'message' => 'Такое поле уже существует!',
                'filter' => ['<>', 'id', $this->id ?? 0]
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя поля'
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
