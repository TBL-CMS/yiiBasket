<?php
class Products extends SiteActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'basket_products';
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'media'=>array(self::MANY_MANY, 'CmsMedia', 'cms_content_media(content_id, media_id)', 'condition' => 'type = "offers"'),
			'variations' => array(self::HAS_MANY, 'ProductsVariation', 'product_id', 'order' => 'listing_order'),
			'delivery' => array(self::HAS_MANY, 'ProductsDelivery', 'product_id'),
			'orders' => array(self::HAS_MANY, 'OrdersItems', 'product_id', 'order' => 'id'), 
		);
	}
	
	public function getAllVariations() {
		$variations = array();
		foreach($this->variations as $variation) {
			$variations[$variation->specification_id][] = $variation;
		}		

		return $variations;
	}
	
	public function getVariations($product) {
		$variations = '';
		if(isset($product['Variations'])) {
		 	foreach($product['Variations'] as $specification => $variation): 
				if($specification = OffersSpecification::model()->findByPk($specification)) {
					$variation = OffersVariation::model()->findByPk($variation);
					$variations .= $specification->title . ': ' . $variation->title ;
				}
			endforeach;
		}
		
		return $variations;
	}
	
	public function getPrice($variations = null, $amount = 1, $shipping = null) {
		$price = (float) $this->price;

		if($variations) {
			foreach($variations as $key => $variation) { 
				if($variation)
					$price += ProductsVariation::model()->findByPk($variation)->getPriceAdjustion();
			}
		}
		
		if($shipping) {
			$price += $this->getShippingCost($shipping);
		}

		return (float) $price *= $amount;
	}
	
	public function getShippingCost($id)
	{
		$model=ProductsDelivery::model()->findByPk($id);
		return $model->delivery_cost;
	}
}