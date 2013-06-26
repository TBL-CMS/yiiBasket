<?php

/**
 * This is the model class for table "basket_customer".
 *
 * The followings are the available columns in table 'basket_customer':
 * @property string $id
 * @property integer $user_id
 * @property string $firstName
 * @property string $lastName
 * @property integer $telephone
 * @property integer $address_id
 * @property integer $delivery_address_id
 * @property integer $billing_address_id
 * @property string $created
 * @property string $updated
 * @property integer $listing_order
 * @property integer $active
 * @property integer $deleted
 */
class Customer extends SiteActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'basket_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, telephone, address_id, delivery_address_id, billing_address_id, listing_order, active, deleted', 'numerical', 'integerOnly'=>true),
			array('firstName, lastName', 'length', 'max'=>50),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, firstName, lastName, telephone, address_id, delivery_address_id, billing_address_id, created, updated, listing_order, active, deleted', 'safe', 'on'=>'search'),
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
			'media'=>array(self::MANY_MANY, 'CmsMedia', 'cms_content_media(content_id, media_id)', 'condition' => 'type = "customer"'),
			'user' => array(self::BELONGS_TO, 'CmsUser', 'user_id'),
			'orders' => array(self::HAS_MANY, 'Orders', 'customer_id'),
			//'ShoppingCarts' => array(self::HAS_MANY, 'ShoppingCart', 'customer_id'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'billingAddress' => array(self::BELONGS_TO, 'BillingAddress', 'billing_address_id'),
			'deliveryAddress' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_address_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'telephone' => 'Telephone',
			'address_id' => 'Address',
			'delivery_address_id' => 'Delivery Address',
			'billing_address_id' => 'Billing Address',
			'created' => 'Created',
			'updated' => 'Updated',
			'listing_order' => 'Listing Order',
			'active' => 'Active',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('telephone',$this->telephone);
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('delivery_address_id',$this->delivery_address_id);
		$criteria->compare('billing_address_id',$this->billing_address_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('listing_order',$this->listing_order);
		$criteria->compare('active',$this->active);
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
    	$sql .= " AND cm.type='customer'";
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
				        url('/Customer/toggleActive'),
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
		$result .= '&nbsp;&nbsp;'.l('Edit',array('/Customer/update', 'id'=>$this->id), array('class'=>'btn btn-mini btn-primary'));
    	$result .= '&nbsp;&nbsp;'.l('Delete','', array('class'=>'btn btn-mini delete_dialog', 'data-url'=>url("/Customer/delete",array('id'=>$this->id))));

    	return $result;
	}
}