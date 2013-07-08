<?php
/* @var $this OffersController */
/* @var $model Offers */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offers-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>

	<?php if( $form->errorSummary($model)  ) { ?>
	<div class="row-fluid">
      <div class="widget widget-padding span12">
        <div class="widget-header">
          <i class="icon-external-link"></i><h5>Errors:</h5>
          <div class="widget-buttons">
              <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="widget-body">
          <div class="alert alert-info" style="margin:0;">
            <?php echo $form->errorSummary($model); ?>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    
<?php if(\Yii::app()->user->hasFlash('success')):?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong>  
</div>
<?php endif; ?>

<div class="row-fluid">
  <div class="widget widget-padding span12" id="wizard">
		
    <div class="widget-header">
      <ul class="nav nav-tabs">
        <li><a href="#validate_tab1" data-toggle="tab">Basic Info</a></li>
        <li><a href="#validate_tab3" data-toggle="tab">Address</a></li>
        <li><a href="#validate_tab4" data-toggle="tab">Delivery</a></li>
        <li><a href="#validate_tab5" data-toggle="tab">Options</a></li>
        <li><a href="#validate_tab6" data-toggle="tab">Sales</a></li>
        <li><a href="#validate_tab2" data-toggle="tab">Media</a></li>
      </ul>
    </div>
    <div class="widget-body">
      <div class="tab-content">     
        
      	<div class="tab-pane" id="validate_tab1">
        		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'title'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'title'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'under_title'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model,'under_title',array('size'=>60,'maxlength'=>255)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'under_title'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'main_features'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'main_features',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'main_features'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'deal'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'deal',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'deal'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'important_information'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'important_information',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'important_information'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'overview'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'overview',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'overview'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'next_step'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'next_step',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'next_step'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'price'); ?>
	          	<div class="controls">
	          		
	          		<div class="input-append">
                       <?php echo $form->textField($model,'price',array('class'=>'span7','placeholder'=>'5.00')); ?><span class="add-on">&pound;</span>
                    </div>
	          		<span class="help-inline"><?php echo $form->error($model,'price'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'saving'); ?>
	          	<div class="controls">
	          		<div class="input-append">
                       <?php echo $form->textField($model,'saving',array('class'=>'span7','placeholder'=>'5.00')); ?><span class="add-on">&pound;</span>
                    </div>
	          		<span class="help-inline"><?php echo $form->error($model,'saving'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'number_available'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model,'number_available',array('class'=>'span3')); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'number_available'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'terms'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'terms',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'terms'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'exclusive'); ?>
	          	<div class="controls">
	          		<?=$form->dropDownList($model,'exclusive',array(0=>'No', 1=>'Yes'), array('class'=>'span7'));?>
	          		<span class="help-inline"><?php echo $form->error($model,'exclusive'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'purchase_next_step'); ?>
	          	<div class="controls">
	          		<?php $this->widget('ext.tinymce.TinyMce', array(
								    'model' => $model,
								    'attribute' => 'purchase_next_step',
								    'htmlOptions' => array(
								        'rows' => 6,
								        'cols' => 60,
								    ),
								)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'purchase_next_step'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'merchant_id'); ?>
	          	<div class="controls">
	          		<?=$form->dropDownList($model,'merchant_id',Merchant::listMerchants(), array('class'=>'span7'));?>
	          		<span class="help-inline"><?php echo $form->error($model,'merchant_id'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'listing_order'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model,'listing_order'); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'listing_order'); ?>
</span>
	          	</div>
	          	
	          </div>
          		       
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'date_start'); ?>
	          	<div class="controls">
	          		<div class="input-append date span5 datepicker datepicker-basic" data-date="<?=date("d-m-Y", strtotime($model->date_start));?>" data-date-format="dd-mm-yyyy">
	          			<?php echo $form->textField($model,'date_start',array('size'=>16)); ?>
                    	<span class="add-on"><i class="icon-th"></i></span>
                    </div>
	          		<span class="help-inline"><?php echo $form->error($model,'date_start'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'date_end'); ?>
	          	<div class="controls">
	          		<div class="input-append date span5 datepicker datepicker-basic" data-date="<?=date("d-m-Y", strtotime($model->date_end));?>" data-date-format="dd-mm-yyyy">
	          			<?php echo $form->textField($model,'date_end',array('size'=>16)); ?>
                    	<span class="add-on"><i class="icon-th"></i></span>
                    </div>
	          		<span class="help-inline"><?php echo $form->error($model,'date_end'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'active'); ?>
	          	<div class="controls">
	          		<?=$form->dropDownList($model,'active',array(0=>'No', 1=>'Yes'), array('class'=>'span7'));?>
	          		<span class="help-inline"><?php echo $form->error($model,'active'); ?>
</span>
	          	</div>
	          	
	          </div>
	          
          	      	</div>
      	
      	<div class="tab-pane" id="validate_tab3"> 
	  
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'address_line_1'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'address_line_1'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'address_line_1'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'address_line_2'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'address_line_2'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'address_line_2'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'town'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'town'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'town'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'county'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'county'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'county'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'postcode'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'postcode'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'postcode'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'telephone'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'telephone'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'telephone'); ?></span>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model->address,'email'); ?>
				<div class="controls">
					<?php echo $form->textField($model->address,'email'); ?>
					<span class="help-inline"><?php echo $form->error($model->address,'email'); ?></span>
				</div>
			</div>
	          
	    </div>
	    
	    <div class="tab-pane" id="validate_tab4"> 
	      	
	      	<div class="row-fluid">
		      <div class="span12">
		      	<a href="<?=url('productsDelivery/create', array('product_id'=>$model->id));?>" class="btn btn-primary">+Add</a>
		        <table class="table" id="gallery-container">
		          <thead>
		            <tr>
		              <th>Type</th>
		              <th>Cost</th>
		              <th>Actions</th>
		            </tr>
		          </thead>
		          <tbody>
		          	<? foreach($model->delivery as $delivery): ?>
		          		<tr>
						  <td><?=$delivery->title;?></td>
						  <td><?=$delivery->delivery_cost;?></td>
						  <td><?=$delivery->adminActions();?></td>
						</tr>
		            <? endforeach; ?>
		          </tbody>
		        </table>
		      </div>
		    </div> 
			
	    </div>
	    
	    <div class="tab-pane" id="validate_tab5"> 
	      	
	      	<div class="row-fluid">
		      <div class="span12">
		      	<a href="<?=url('productsVariation/create', array('product_id'=>$model->id));?>" class="btn btn-primary">+Add</a>
		        <table class="table" id="gallery-container">
		          <thead>
		            <tr>
		              <th>Type</th>
		              <th>Cost</th>
		              <th>Actions</th>
		            </tr>
		          </thead>
		          <tbody>
		          	<? foreach($model->variations as $variations): ?>
		          		<tr>
						  <td><?=$variations->title;?></td>
						  <td><?=$variations->price_adjustion;?></td>
						  <td><?=$variations->adminActions();?></td>
						</tr>
		            <? endforeach; ?>
		          </tbody>
		        </table>
		      </div>
		    </div> 
		    
	    </div>
	    
	    <div class="tab-pane" id="validate_tab6"> 
	      	
	      	<div class="row-fluid">
		      <div class="span12">
		      	<a href="#" class="btn btn-primary">+Add</a>
		        <table class="table" id="gallery-container">
		          <thead>
		            <tr>
		              <th>Type</th>
		              <th>Cost</th>
		              <th>Actions</th>
		            </tr>
		          </thead>
		          <tbody>
		          	<? if($model->orders) { ?>
			          	<? foreach($model->orders as $orders): ?>
			          		<tr>
							  <td><?=$orders->order_id;?></td>
							  <td><?=$orders->amount;?></td>
							  <td><?=$orders->adminActions();?></td>
							</tr>
			            <? endforeach; ?>
		            <? } else { ?>
		            		<tr><td>No Orders!</td></tr>
		            <? } ?>
		          </tbody>
		        </table>
		      </div>
		    </div> 
		    
	    </div>
	    
      	<div class="tab-pane" id="validate_tab2"> 
	      	<!-- Media manager here -->
	      	<?php $this->widget('cms.widgets.CmsMediaManager', array('model'=>$model, 'type'=>'offers')) ?>
	    </div>
      	 
      </div>
    </div>
    <div class="widget-footer">
    	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
    </div>
    
  </div>
</div>  

<?php $this->endWidget(); ?>
