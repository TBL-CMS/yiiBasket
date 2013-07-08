<?php

/**
 * This is the model class for table "offers_delivery".
 *
 * The followings are the available columns in table 'offers_delivery':
 * @property string $id
 * @property integer $product_id
 * @property string $delivery_type
 * @property string $delivery_cost
 */
class ProductsDelivery extends SiteActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductsDelivery the static model class
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
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, delivery_cost', 'safe'),
			array('id, description, delivery_cost', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'product'=>array(self::BELONGS_TO, 'Products', 'product_id'),
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
			'title' => 'Title',
			'description' => 'Description',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('title',$this->title,true);

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
    
    public function adminActions()
    {
    	$result = l('Edit',array('/productsDelivery/update', 'id'=>$this->id), array('class'=>'btn btn-mini btn-primary'));
    	$result .= '&nbsp;&nbsp;'.l('Delete','', array('class'=>'btn btn-mini delete_dialog', 'data-url'=>url("/productsDelivery/delete",array('id'=>$this->id))));
    	
    	return $result;
    }
	
}