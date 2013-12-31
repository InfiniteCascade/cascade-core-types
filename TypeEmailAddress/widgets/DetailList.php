<?php

namespace cascade\modules\core\TypeEmailAddress\widgets;

class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public $renderContentTemplate = ['mailLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5']];
}
