<?php

	class DeliveryAddress extends Address {

		// This address is not *required*
		public function rules()
		{
			return array(
				array('deleted', 'numerical', 'integerOnly'=>true),
				array('title', 'length', 'max'=>20),
				array('firstname, lastname, postal, city, region, country', 'length', 'max'=>50),
				array('street', 'length', 'max'=>255),
				array('id, title, firstname, lastname, street, postal, city, region, country, deleted', 'safe', 'on'=>'search'),
			);
		}

	}
?>
