<?php
     
class MyBasket extends CApplicationComponent
{
	public $shopName = 'My Shop';
	
	// Set this to enable Paypal payment. See docs/paypal.txt
	public $payPalMethod = true;
	public $payPalTestMode = true;
	public $payPalUrl = '/yiiBasket/order/paypal';
	public $payPalBusinessEmail = 'webmaster@example.com';
	
	public $orderNotificationFromEmail = 'do@not-reply.org';
	public $orderNotificationReplyEmail = 'do@not-reply.org';
	
	public function updateAmountScript($position)
	{
		Yii::app()->clientScript->registerScript('amount_'.$position,"
					$('.amount_".$position."').keyup(function() {
						$.ajax({
							url:'".Yii::app()->controller->createUrl('/yiiBasket/basket/updateAmount')."',
							data: $('#amount_".$position."'),
							success: function(result) {
							$('.amount_".$position."').css('background-color', 'lightgreen');
							$('.widget_amount_".$position."').css('background-color', 'lightgreen');
							$('.widget_amount_".$position."').html($('.amount_".$position."').val());
							$('.price_".$position."').html(result);	
							$('.price_total').load('".Yii::app()->controller->createUrl(
							'/yiiBasket/basket/getPriceTotal')."');

							},
							error: function() {
							$('#amount_".$position."').css('background-color', 'red');
							},

							});
				});
					");
					
		Yii::app()->clientScript->registerScript('shipping_'.$position,"
					$('.shipping_".$position."').change(function() {
						$.ajax({
							url:'".Yii::app()->controller->createUrl('/yiiBasket/basket/updateShippingType')."',
							data: $('#shipping_".$position."'),
							success: function(result) {
							var obj = jQuery.parseJSON(result);
							$('.amount_".$position."').css('background-color', 'lightgreen');
							$('.widget_amount_".$position."').css('background-color', 'lightgreen');
							$('.widget_amount_".$position."').html($('.amount_".$position."').val());
							$('.price_".$position."').html(obj.totalPrice);	
							$('.price_total').load('".Yii::app()->controller->createUrl(
							'/yiiBasket/basket/getPriceTotal')."');
							$('.shipping_cost_".$position."').html(obj.shippingCost);

							},
							error: function() {
							$('#amount_".$position."').css('background-color', 'red');
							},

							});
				});
					");
	}
}