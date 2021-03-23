<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vuelos".
 *
 * @property int $id
 * @property int $origen_id
 * @property int $destino_id
 * @property string $salida
 * @property string $llegada
 * @property int $plazas
 * @property float $precio
 *
 * @property Reservas[] $reservas
 * @property Usuarios[] $usuarios
 * @property Aeropuertos $origen
 * @property Aeropuertos $destino
 */
class Vuelos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vuelos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['origen_id', 'destino_id', 'salida', 'llegada', 'plazas', 'precio'], 'required'],
            [['origen_id', 'destino_id', 'plazas'], 'default', 'value' => null],
            [['origen_id', 'destino_id'], 'integer'],
            [['plazas'], 'integer', 'min' => 0],
            [['origen_id'], 'compare', 'compareAttribute' => 'destino_id', 'operator' => '!=='],
            [['salida', 'llegada'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['precio'], 'number'],
            [['origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aeropuertos::class, 'targetAttribute' => ['origen_id' => 'id']],
            [['destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aeropuertos::class, 'targetAttribute' => ['destino_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'origen_id' => 'Origen ID',
            'destino_id' => 'Destino ID',
            'salida' => 'Salida',
            'llegada' => 'Llegada',
            'plazas' => 'Plazas',
            'precio' => 'Precio',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['vuelo_id' => 'id'])
            ->inverseOf('vuelo');
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::class, ['id' => 'usuario_id'])
            ->viaTable('reservas', ['vuelo_id' => 'id']);
    }

    /**
     * Gets query for [[Origen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrigen()
    {
        return $this->hasOne(Aeropuertos::class, ['id' => 'origen_id'])
            ->inverseOf('vuelosOrigen');
    }

    /**
     * Gets query for [[Destino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestino()
    {
        return $this->hasOne(Aeropuertos::class, ['id' => 'destino_id'])
            ->inverseOf('vuelosDestino');
    }
}
