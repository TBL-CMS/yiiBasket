<h2>Order #<?php echo $model->order_Code; ?></h2>

<h3>Ordering Info</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'order_code',
            'customer_id',
            'comment',
            array(
                'label' => 'Ordering Date',
                'value' => $model->created,
            ),
            array(
                'label' => 'Status',
                'value' => $model->status,
            )
        )
    )
);

?>

<h3>Customer Info</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model->customer->user,
    'attributes'=>array(
        'email',
    ),
)); ?>

<div class="summary_delivery_address">
    <h3>Delivery address</h3>
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model->deliveryAddress,
        'attributes'=>array(
            'title',
            'firstname',
            'lastname',
            'street',
            'zipcode',
            'city',
            'country'
        ),
    )); ?>
</div>

<div class="summary_billing_address">
    <h3>Billing address</h3>
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model->billingAddress,
        'attributes'=>array(
            'firstname',
            'title',
            'lastname',
            'street',
            'zipcode',
            'city',
            'country'
        ),
    )); ?>
</div>


<h3>Ordered Products</h3>

<?php
if($model->items)
    foreach($model->items as $position) {

        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$position,
                'attributes'=> array(
                    'product.title',
                    'amount',
                    array(
                        'label' => 'Specifications',
                        'type' => 'raw',
                        'value' => $position->listSpecifications())
                )
            )
        );
    }
echo '<hr />';

?>

<div style="clear:both;"> </div>