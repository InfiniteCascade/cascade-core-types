<?php
use infinite\helpers\Html;
echo Html::beginTag('ul', ['class' => 'list-group']);
echo Html::beginTag('li', ['class' => 'list-group-item']);
echo Html::tag('span', $stats['total'], ['class' => 'badge']);
echo 'Total';
echo Html::endTag('li');

if (!empty($stats['top_contributors'])) {
	echo Html::beginTag('li', ['class' => 'list-group-item']);
	echo '<h5>Top Contributors</h5>';
	echo Html::beginTag('ul', ['class' => 'list-group']);
	foreach ($stats['top_contributors'] as $id => $contrib) { 
		echo Html::beginTag('li', ['class' => 'list-group-item']);
		echo Html::tag('span', $contrib['sum'], ['class' => 'badge']);
		echo Html::a($contrib['label'], ['/object/view', 'id' => $id, 'p' => Yii::$app->request->object->primaryKey]);
		echo Html::endTag('li');
	}
	echo Html::endTag('ul');
}



if (!empty($stats['month_summary'])) {
	echo Html::beginTag('li', ['class' => 'list-group-item']);
	echo '<h5>Month Summaries</h5>';
	echo Html::beginTag('ul', ['class' => 'list-group']);
	foreach ($stats['month_summary'] as $month => $sum) { 
		echo Html::beginTag('li', ['class' => 'list-group-item']);
		echo Html::tag('span', $sum['sum'], ['class' => 'badge']);
		echo date('F Y', strtotime($month .'-01'));
		echo Html::endTag('li');
	}
	echo Html::endTag('ul');
}

echo Html::endTag('ul');
?>