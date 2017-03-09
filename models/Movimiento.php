<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movimientos".
 *
 * @property integer $id
 * @property string $fecha_aparicion
 * @property string $concepto
 * @property string $importe
 * @property integer $id_cuenta
 *
 * @property Cuentas $idCuenta
 */
class Movimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movimientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_aparicion'], 'safe'],
            [['concepto', 'importe'], 'required'],
            [['importe'], 'number'],
            [['id_cuenta'], 'integer'],
            [['concepto'], 'string', 'max' => 200],
            [['id_cuenta'], 'exist', 'skipOnError' => true, 'targetClass' => Cuenta::className(), 'targetAttribute' => ['id_cuenta' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_aparicion' => 'Fecha Aparicion',
            'concepto' => 'Concepto',
            'importe' => 'Importe',
            'id_cuenta' => 'Id Cuenta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCuenta()
    {
        return $this->hasOne(Cuenta::className(), ['id' => 'id_cuenta'])->inverseOf('movimientos');
    }
}
