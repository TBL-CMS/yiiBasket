<? echo CHtml::beginForm(array('/yiiBasket/basket/create')); ?>

	<? if($variations = $model->getAllVariations()) { 
		foreach($variations as $variation) {	
			$field = "Variations[{$variation[0]->specification_id}][]";
		
			echo CHtml::label($variation[0]->specification->title, $field, array('class' => 'lbl-header'));
			if($variation[0]->specification->required)
				echo ' <span class="required">*</span>';
			
			//echo CHtml::textField($field);
			echo CHtml::radioButtonList($field, $variation[0]->specification->required ? $variation[0]->id : null, ProductsVariation::listData($variation));
		}
	} ?>
	
	<? echo CHtml::hiddenField('product_id', $model->id); ?>
	<? echo CHtml::label('Amount', 'ShoppingCart_amount'); ?>
	<? echo CHtml::textField('amount', 1, array('size' => 3)); ?>
	
	<? /*if($model->delivery) { 
		echo 'Delivery Type: ';
		echo CHtml::dropDownList('ShippingMethod','ShippingMethod', CHtml::listData($model->delivery, 'id', 'title')); 
	}*/ ?>

	<? echo CHtml::submitButton('Add to shopping Cart', array( 'class' => 'btn-add-cart')); ?>
	
<? echo CHtml::endForm(); ?>