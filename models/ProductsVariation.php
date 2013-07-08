<?php

/**
 * This is the model class for table "offers_variation".
 *
 * The followings are the available columns in table 'offers_variation':
 * @property integer $id
 * @property integer $offer_id
 * @property integer $specification_id
 * @property string $title
 * @property string $price_adjustion
 * @property integer $listing_order
 */
class ProductsVariation extends SiteActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OffersVariation the static model class
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
		return 'basket_products_variation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, title, price_adjustion', 'required'),
			array('product_id, specification_id, listing_order', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('price_adjustion', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, specification_id, title, price_adjustion, listing_order', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product'=>array(self::BELONGS_TO, 'Products', 'product_id'),
			'specification' => array(self::BELONGS_TO, 'ProductsSpecification', 'specification_id'),
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
			'specification_id' => 'Specification',
			'title' => 'Title',
			'price_adjustion' => 'Price Adjustion',
			'listing_order' => 'Listing Order',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('offer_id',$this->offer_id);
		$criteria->compare('specification_id',$this->specification_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price_adjustion',$this->price_adjustion,true);
		$criteria->compare('listing_order',$this->listing_order);

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
            	//find listing Order number of last
            	$criteria=new CDbCriteria;
            	$criteria->order='listing_order DESC';
            	$lastID=$this::model()->find($criteria);
            	$listOrderId = $lastID->listing_order+1;
            	//Update Listing order
            	$this->listing_order=$listOrderId;
            } else {

            }
            
            return true;
		}
		else
			return false;
    }
	
	/**
	 * If $price_absolute is set to true, display the absolute price in 
	 * brackets (25 $), otherwise the relative price (+ 5 $)
	 */
	public static function listData($variations, $price_absolute = false) {
		$var = array();

		foreach($variations as $id => $variation)  {
			if($price_absolute)
				$var[$variation->id] = sprintf(
						'<div class="variation">%s</div> <div class="price">%s</div>',
						$variation->title,
						ShopBasket::priceFormat(
							$variation->product->getPrice() + $variation->getPriceAdjustion()));
			else
				$var[$variation->id] = sprintf(
						'<div class="variation">%s</div> <div class="price">%s%s</div>',
						$variation->title,
						$variation->price_adjustion > 0 ? '+' : '',
						ShopBasket::priceFormat($variation->getPriceAdjustion()));
		}

		return $var;
	}
	
	public function getPriceAdjustion() {
		return $this->price_adjustion;
	}
	
	public function adminActions()
    {
    	$result = l('Edit',array('/productsVariation/update', 'id'=>$this->id), array('class'=>'btn btn-mini btn-primary'));
    	$result .= '&nbsp;&nbsp;'.l('Delete','', array('class'=>'btn btn-mini delete_dialog', 'data-url'=>url("/productsVariation/delete",array('id'=>$this->id))));
    	
    	return $result;
    }
	
}