<?php
namespace app\models;

class CuentaForm extends \yii\base\Model
{
    public $num_cuenta;

    public function rules()
    {
        return [
            [['num_cuenta'], 'required'],
            [['num_cuenta'], 'exist',
                'skipOnError' => true,
                'targetClass' => Cuenta::className(),
                'targetAttribute' => ['num_cuenta' => 'num_cuenta']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'num_cuenta' => 'Nº Cuenta',
        ];
    }
}
