<? if($products) { ?>

	<? foreach($products as $position => $product): ?>
	
		<? if($model = Offers::model()->findByPk($product['product_id'])): ?>
		
			<?=CHtml::textField('amount_'.$position,
				$product['amount'], array(
					'size' => 4,
					'class' => 'amount_'.$position,
					)
				);?>
			<?=$model->title;?>
			<?=$model->getVariations($product);?>
			ItemCost: <?=ShopBasket::priceFormat($model->getPrice($product['Variations']));?>
			TotalCost: <span class="price_<?=$position;?>"><?=ShopBasket::priceFormat($model->getPrice($product['Variations'], $product['amount'], $product['ShippingMethod']));?></span>
				
			<? if($model->delivery) { 
					echo 'Delivery Type: ';
					echo CHtml::dropDownList('shipping_'.$position, $product['ShippingMethod'], CHtml::listData($model->delivery, 'id', 'title'), array('class'=>'shipping_'.$position)); 
					if($product['ShippingMethod']) {
						echo 'ShippingCost: ';
						echo '<span class="shipping_cost_'.$position.'">'.ShopBasket::priceFormat($model->getShippingCost($product['ShippingMethod'])).'</span>';
					}
				} ?>
				
			<?=CHtml::link('Remove', array(
					'/yiiBasket/basket/delete',
					'id' => $position), array(
						'confirm' => 'Are you sure?'
					 )
				);?>
				
			<? Yii::app()->myBasket->updateAmountScript($position); ?>
			
		<? endif; ?>
		<br />
	<? endforeach; ?>
	
	Total: <span class="price_total"><?=ShopBasket::getPriceTotal();?></span><br />
	
	<?=CHtml::link('Buy these products', array('/yiiBasket/order/create'));?>

<? } else { ?>
	Your shopping cart is empty
<? } ?>