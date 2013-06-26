<?php
	/* function getSpecifications($position) {
		$string = '<table class="specifications">';
		foreach($position->getSpecifications() as $key =>$specification) {
			if($model = ProductsSpecification::model()->findByPk($key)) {
				$title = $model->title;				
				$productvariation = ProductsVariation::model()->findByPk($specification[0]);
				if($productvariation)
					$value = $productvariation->title;
				else
					$value = '';
			} else if($key == 'image')  {
				$title = 'Filename';
				$value = $specification;
			}

			$string .= sprintf('<tr><td>%s</td><td>%s</td></tr>',
					@$title,
					@$value	
					);
		}
		$string .= '</table>';
		return $string;
	}

	$this->widget('zii.widgets.CDetailView', array(
				'data'=>$position,
				'attributes'=> array(
					'product.title',
					'amount',
					array(
						'label' => 'Specifications',
						'type' => 'raw',
						'value' => getSpecifications($position))
					)
				)
			); 


