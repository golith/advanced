<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "po_item".
 *
 * @property int $id
 * @property string $po_item_no
 * @property double $quantity
 * @property int $po_id
 *
 * @property Po $po
 */
class PoItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'po_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['po_item_no', 'quantity'], 'required'],
            [['quantity'], 'number'],
            [['po_id'], 'integer'],
            [['po_item_no'], 'string', 'max' => 10],
            [['po_id'], 'exist', 'skipOnError' => true, 'targetClass' => Po::className(), 'targetAttribute' => ['po_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'po_item_no' => Yii::t('app', 'Po Item No'),
            'quantity' => Yii::t('app', 'Quantity'),
            'po_id' => Yii::t('app', 'Po ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return $this->hasOne(Po::className(), ['id' => 'po_id']);
    }
}
