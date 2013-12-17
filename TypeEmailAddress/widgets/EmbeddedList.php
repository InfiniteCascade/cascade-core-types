<?php

namespace cascade\modules\core\TypeEmailAddress\widgets;

class EmbeddedList extends \cascade\components\web\widgets\base\SideList
{
	public $renderContentTemplate = ['mailLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5']];
}
