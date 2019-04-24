<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\admin\models;

use app\models\SponsorType;
/**
 * Description of SponsorTypeForm
 *
 * @author Granik
 */
class SponsorTypeForm extends SponsorType {
    
    public function rules() {
        return [
                    ['name', 'string', 'min' => 2, 'max' => 30],
                    ['name', 'required'],
                    ['name', 'unique', 'targetClass' => '\app\models\SponsorType', 
                        'message' => 'Такой тип спонсора уже существует!', 
                        'filter' => ['=', 'is_deleted', 0]
                        ]
               ];
    }
    
    public function attributeLabels() {
        return [
            'name' => 'Тип спонсора'
        ];
    }
}
