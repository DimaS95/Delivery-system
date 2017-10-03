<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courier".
 *
 * @property integer $courier_id
 * @property string $name
 * @property integer $positive
 * @property integer $negative
 *
 * @property Delivery[] $deliveries
 */
class Courier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courier_id'], 'required'],
            [['courier_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'courier_id' => 'Courier ID',
            'name' => 'Name',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveries()
    {
        return $this->hasMany(Delivery::className(), ['courier_id' => 'courier_id']);
    }
}
