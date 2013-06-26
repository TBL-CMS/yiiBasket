Yii Basket Module
=================

Yii Basket based on Yii Framework

Setup:
------
Add following to main.php config
'import'=>array(
	'application.modules.yiiBasket.YiiBasketModule',
	'application.modules.yiiBasket.components.*',
	'application.modules.yiiBasket.models.*',
),
'modules'=>array(
	'yiiBasket',
),
'components'=>array(
	'myBasket'=>array('class'=>'yiiBasket.components.MyBasket'),
),

Configure module in: /components/MyBasket.php

Database structure is in: /data/

Know Issues / ToDo
------------------
- 