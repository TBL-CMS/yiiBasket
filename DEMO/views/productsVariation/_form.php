<?php
/* @var $this ProductsVariationController */
/* @var $model ProductsVariation */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-variation-form',
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
      </ul>
    </div>
    <div class="widget-body">
      <div class="tab-content">     
        
      	<div class="tab-pane" id="validate_tab1">
        		          <div class="control-group">
	          	<?php echo $form->labelEx($model->product,'title'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model->product,'title', array('disabled'=>'true')); ?>
	          		<span class="help-inline"><?php echo $form->error($model->product,'title'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'specification_id'); ?>
	          	<div class="controls">
	          		<?=$form->dropDownList($model,'specification_id',ProductsSpecification::listSpecifications(), array('class'=>'span7'));?>
	          		<span class="help-inline"><?php echo $form->error($model,'specification_id'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'title'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'title'); ?>
</span>
	          	</div>
	          	
	          </div>
          		          <div class="control-group">
	          	<?php echo $form->labelEx($model,'price_adjustion'); ?>
	          	<div class="controls">
	          		<?php echo $form->textField($model,'price_adjustion',array('size'=>10,'maxlength'=>10)); ?>
	          		<span class="help-inline"><?php echo $form->error($model,'price_adjustion'); ?>
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
          	      	</div>
      	
      	 
      </div>
    </div>
    <div class="widget-footer">
    	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
    </div>
    
  </div>
</div>  

<?php $this->endWidget(); ?>
