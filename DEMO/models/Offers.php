<?php

/**
 * This is the model class for table "offers".
 *
 * The followings are the available columns in table 'offers':
 * @property integer $id
 * @property string $title
 * @property string $under_title
 * @property string $main_features
 * @property string $deal
 * @property string $important_information
 * @property string $overview
 * @property string $next_step
 * @property string $price
 * @property string $saving
 * @property integer $number_available
 * @property integer $number_available_at_insert
 * @property string $terms
 * @property integer $exclusive
 * @property string $purchase_next_step
 * @property integer $merchant_id
 * @property integer $listing_order
 * @property string $created
 * @property string $updated
 * @property string $date_start
 * @property string $date_end
 * @property integer $active
 * @property integer $deleted
 */
class Offers extends Products
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Offers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('number_available, number_available_at_insert, exclusive, merchant_id, listing_order, active, deleted', 'numerical', 'integerOnly'=>true),
			array('title, under_title', 'length', 'max'=>255),
			array('price, saving', 'length', 'max'=>10),
			array('main_features, deal, important_information, overview, next_step, terms, purchase_next_step, created, updated, date_start, date_end', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, under_title, main_features, deal, important_information, overview, next_step, price, saving, number_available, number_available_at_insert, terms, exclusive, purchase_next_step, merchant_id, listing_order, created, updated, date_start, date_end, active, deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'under_title' => 'Under Title',
			'main_features' => 'Main Features',
			'deal' => 'Deal',
			'important_information' => 'Important Information',
			'overview' => 'Overview',
			'next_step' => 'Next Step',
			'price' => 'Price',
			'saving' => 'Saving',
			'number_available' => 'Number Available',
			'number_available_at_insert' => 'Number Available At Insert',
			'terms' => 'Terms',
			'exclusive' => 'Exclusive',
			'purchase_next_step' => 'Purchase Next Step',
			'merchant_id' => 'Merchant',
			'listing_order' => 'Listing Order',
			'created' => 'Created',
			'updated' => 'Updated',
			'date_start' => 'Date Start',
			'date_end' => 'Date End',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('under_title',$this->under_title,true);
		$criteria->compare('main_features',$this->main_features,true);
		$criteria->compare('deal',$this->deal,true);
		$criteria->compare('important_information',$this->important_information,true);
		$criteria->compare('overview',$this->overview,true);
		$criteria->compare('next_step',$this->next_step,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('saving',$this->saving,true);
		$criteria->compare('number_available',$this->number_available);
		$criteria->compare('number_available_at_insert',$this->number_available_at_insert);
		$criteria->compare('terms',$this->terms,true);
		$criteria->compare('exclusive',$this->exclusive);
		$criteria->compare('purchase_next_step',$this->purchase_next_step,true);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('listing_order',$this->listing_order);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
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
    	$sql .= " AND cm.type='offers'";
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
				        url('/Offers/toggleActive'),
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
		$result .= '&nbsp;&nbsp;'.l('Edit',array('/Offers/update', 'id'=>$this->id), array('class'=>'btn btn-mini btn-primary'));
    	$result .= '&nbsp;&nbsp;'.l('Delete','', array('class'=>'btn btn-mini delete_dialog', 'data-url'=>url("/Offers/delete",array('id'=>$this->id))));

    	return $result;
	}

}