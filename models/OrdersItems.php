<?php

/**
 * This is the model class for table "basket_orders_items".
 *
 * The followings are the available columns in table 'basket_orders_items':
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property double $amount
 * @property string $specifications
 */
class OrdersItems extends SiteActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrdersItems the static model class
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
		return 'basket_orders_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, amount, specifications', 'required'),
			array('order_id, product_id', 'numerical', 'integerOnly'=>true),
			array('amount, shipping_method', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, product_id, amount, specifications, shipping_method', 'safe', 'on'=>'search'),
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
			'media'=>array(self::MANY_MANY, 'CmsMedia', 'cms_content_media(content_id, media_id)', 'condition' => 'type = "ordersitems"'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
			'shippingMethod' => array(self::BELONGS_TO, 'ProductsDelivery', 'shipping_method'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'product_id' => 'Product',
			'amount' => 'Amount',
			'specifications' => 'Specifications',
			'shipping_method' => 'Shipping Method',
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('specifications',$this->specifications,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Model class can have a default scope that would be applied for all queries (including relational ones) about the model. 
	 */
	public function scopes()
    {
        return array(
        	'live'=>array(
            	'order'=>'listing_order ASC',
            	'condition'=>'deleted=0 AND active=1',
            ),
        );
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
    
	/**
	 * This is invoked after the record is deleted.
	 */
	public function afterDelete()
	{	
		parent::afterDelete();
		
		//remove all related media
		foreach($this->media as $media) {
			$media->delete();
		}
	}
	
    /**
     * Returns media in array
     * $rowCount=$command->execute();   // execute the non-query SQL
     * $dataReader=$command->query();   // execute a query SQL
     * $rows=$command->queryAll();      // query and return all rows of result
     * $row=$command->queryRow();       // query and return the first row of result
     * $column=$command->queryColumn(); // query and return the first column of result
     * $value=$command->queryScalar();  // query and return the first field in the first 
     * Usage:
	 * if($media = $data->mediaType(CmsMedia::TYPE_OTHER)) {
	 * 	$image=CmsMedia::getMedia($media['id']);
	 *	dump($image->render());
	 * }
     */
    public function mediaType($type, $count=null)
    {
    	$sql = "SELECT md.* FROM cms_content_media AS cm, cms_media as md";
    	$sql .= " WHERE cm.media_id=md.id";
    	$sql .= " AND cm.type='ordersitems'";
    	$sql .= " AND cm.content_id=".$this->id;
    	$sql .= " AND md.media_type=".$type;
    	
	    $result = Yii::app()->db->createCommand($sql);
	    
	    if($count=='all')
	    	return $result->queryAll();
	    else {
	    	$row = $result->queryRow();
	    	return CmsMedia::model()->findByPk($row['id']);
	    }
    }
	
	public function adminActions()
	{
		$result .= '&nbsp;&nbsp;'.l('Edit',array('/OrdersItems/update', 'id'=>$this->id), array('class'=>'btn btn-mini btn-primary'));
    	$result .= '&nbsp;&nbsp;'.l('Delete','', array('class'=>'btn btn-mini delete_dialog', 'data-url'=>url("/OrdersItems/delete",array('id'=>$this->id))));

    	return $result;
	}
	
	public function getSpecifications() {
		$specs = json_decode($this->specifications, true);
		$specifications = array();
		if($specs)
			foreach($specs as $key => $specification) {
				$specifications[$key] = $specification;
			}

		return $specifications;
	}
	
	public function listSpecifications() {
        if(!$specs = $this->getSpecifications())
            return '';

        $str = '(';
        foreach($specs as $key => $specification) {
            if($model = ProductsSpecification::model()->findByPk($key))
                $value = @ProductsVariation::model()->findByPk($specification[0])->title;

            $str .= $model->title. ': '.$value . ', ';
        }

        $str = substr($str, 0, -2);
        $str .= ')';

        return $str;
    }
	
	public function getPrice() {
		$price = $this->product->price;

		if($this->specifications) {
			foreach($this->getSpecifications() as $key => $spec) {
				$price += @ProductsVariation::model()->findByPk(@$spec[0])->price_adjustion;
			}
		}

        if($this->shipping_method) {
            $price += $this->getShippingCost($this->shipping_method);
        }
		
		return $this->amount * $price;
	}

    public function getShippingCost($id)
    {
        $model=ProductsDelivery::model()->findByPk($id);
        return $model->delivery_cost;
    }
}