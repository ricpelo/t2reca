<?php

namespace app\models;

use yii\base\Model;

class ReservasForm extends Model
{
    public $asiento;

    public function rules()
    {
        return [
            [['asiento'], 'integer', 'min' => 1],
        ];
    }
}
