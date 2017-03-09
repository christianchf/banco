<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuentas".
 *
 * @property integer $id
 * @property string $fecha_apertura
 * @property integer $id_usuario
 *
 * @property Usuarios $idUsuario
 * @property Movimientos[] $movimientos
 */
class Cuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_apertura'], 'safe'],
            [['id_usuario'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_apertura' => 'Fecha Apertura',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('cuentas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::className(), ['id_cuenta' => 'id'])->inverseOf('idCuenta');
    }
}
