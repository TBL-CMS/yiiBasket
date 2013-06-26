<?php

/**
 * This is the model class for table "offers_delivery".
 *
 * The followings are the available columns in table 'offers_delivery':
 * @property string $id
 * @property integer $offer_id
 * @property string $delivery_type
 * @property string $delivery_cost
 */
class ProductsDelivery extends SiteActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OffersDelivery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'basket_products_delivery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id', 'numerical', 'integerOnly'=>true),
			array('delivery_type', 'length', 'max'=>255),
			array('delivery_cost', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, delivery_type, delivery_cost', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'delivery_type' => 'Delivery Type',
			'delivery_cost' => 'Delivery Cost',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->order='id DESC';

		$criteria->compare('id',$this->id,true);
		$criteria->compare('offer_id',$this->offer_id);
		$criteria->compare('delivery_type',$this->delivery_type,true);
		$criteria->compare('delivery_cost',$this->delivery_cost,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * This is invoked before the record is saved.
	 */
	public function beforeSave()
    {
	    if (parent::beforeSave())
	    {
            if ($this->isNewRecord) {
            
            } else {

            }
            
            return true;
		}
		else
			return false;
    }
	
}