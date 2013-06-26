<?php

/**
 * This is the model class for table "basket_orders".
 *
 * The followings are the available columns in table 'basket_orders':
 * @property integer $id
 * @property integer $customer_id
 * @property integer $delivery_address_id
 * @property integer $billing_address_id
 * @property string $delivery_date
 * @property integer $ordering_done
 * @property integer $ordering_confirmed
 * @property string $comment
 * @property string $created
 * @property integer $status
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property ShopCustomer $customer
 */
class Orders extends SiteActiveRecord
{
	CONST STATUS_NEW=0;
	CONST STATUS_IN_PROGRESS=1;
	CONST STATUS_DONE=2;
	CONST STATUS_CANCELLED=3;
		
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Orders the static model class
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
		return 'basket_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, delivery_address_id, billing_address_id', 'required'),
			array('customer_id, delivery_address_id, billing_address_id, ordering_done, ordering_confirmed, payment_method, deleted', 'numerical', 'integerOnly'=>true),
			array('delivery_date, comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, customer_id, delivery_address_id, billing_address_id, delivery_date, ordering_done, ordering_confirmed, payment_method, comment, created, status, deleted', 'safe', 'on'=>'search'),
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
			'media'=>array(self::MANY_MANY, 'CmsMedia', 'cms_content_media(content_id, media_id)', 'condition' => 'type = "orders"'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'items' => array(self::HAS_MANY, 'OrdersItems', 'order_id'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'billingAddress' => array(self::BELONGS_TO, 'BillingAddress', 'billing_address_id'),
			'deliveryAddress' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_address_id'),
			'orderPayment' => array(self::BELONGS_TO, 'PaymentMethod', 'payment_method'),
			'paymentDetails' => array(self::HAS_MANY, 'OrdersPayment', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'delivery_address_id' => 'Delivery Address',
			'billing_address_id' => 'Billing Address',
			'delivery_date' => 'Delivery Date',
			'ordering_done' => 'Ordering Done',
			'ordering_confirmed' => 'Ordering Confirmed',
			'payment_method' => 'Payment',
			'comment' => 'Comment',
			'created' => 'Created',
			'status' => 'Status',
			'deleted' => 'Deleted',
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
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('delivery_address_id',$this->delivery_address_id);
		$criteria->compare('billing_address_id',$this->billing_address_id);
		$criteria->compare('delivery_date',$this->delivery_date,true);
		$criteria->compare('ordering_done',$this->ordering_done);
		$criteria->compare('ordering_confirmed',$this->ordering_confirmed);
		$criteria->compare('payment_method',$this->payment_method);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('deleted',$this->deleted);

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
            	$this->status=self::STATUS_NEW;
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
    	$sql .= " AND cm.type='orders'";
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
		$currentStatus = $this->active==1?'Hide':'Show';
		$statusButton = $this->active==1?'warning':'success';
		
		$result =  CHtml::ajaxLink(
				        $currentStatus,
				        url('/Orders/toggleActive'),
				        array(
			                'update'=>'.btn-hide-'.$this->id,
			                'method'=>'post',
			                'data'=> array( 'id' => $this->id ),
			                /*'success' => "function( data )
			                {
			                	alert( data );
			                }",*/
				        ),
				        array(
				        	'class'=>"btn btn-mini btn-{$statusButton} btn-hide-".$this->id,
				        )
					);	
		$result .= '&nbsp;&nbsp;'.l('Edit',array('/Orders/update', 'id'=>$this->id), array('class'=>'btn btn-mini btn-primary'));
    	$result .= '&nbsp;&nbsp;'.l('Delete','', array('class'=>'btn btn-mini delete_dialog', 'data-url'=>url("/Orders/delete",array('id'=>$this->id))));

    	return $result;
	}
	
	/*public function applyOrderOptions() {
		$order_options = Yii::app()->user->getState('order_options');
		$this->delivery_date = $this->convertDate($order_options['delivery_date']);
	}*/
	
	public function listStatus()
	{
		return array(
			self::STATUS_NEW=>'new',
			self::STATUS_IN_PROGRESS=>'in_progress',
			self::STATUS_DONE=>'done',
			self::STATUS_CANCELLED=>'cancelled',
		);
	}
	
	public function getTotalPrice() {
		$price = 0;
		if($this->items)
			foreach($this->items as $item) {
				$price += $item->getPrice();
			}

		//if($this->shippingMethod)
		//	$price += $this->shippingMethod->price;

		return $price;
	}
}