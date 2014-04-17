<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypePostalAddress\widgets;

use Yii;

use infinite\helpers\Html;
use infinite\helpers\StringHelper;

/**
 * DetailList [@doctodo write class description for DetailList]
 *
 * @author Jacob Morrison <email@ofjacob.com>
**/
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public $renderContentTemplate = ['descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'], 'address1', 'address2', 'csz', 'uniqueCountry'];
	
	/**
	* @inheritdoc
	**/
	public function contentTemplate($model)
	{
		if ($model->can('read')) {
			return [
				'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
				'address1' => [],
				'address2' => [],
				'csz' => [],
				'uniqueCountry' => []
			];
		} else {
			return [
				'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
			];
		}
	}

	/**
	* @inheritdoc
	**/
	public function getMenuItems($model, $key, $index)
	{
		$base = parent::getMenuItems($model, $key, $index);
		$base['map'] = [
			'icon' => 'fa fa-globe',
			'label' => 'View map',
			'url' => StringHelper::parseText(Yii::$app->params['helperUrls']['map'], ['object' => $model]),
			'linkOptions' => ['target' => '_blank']
		];
		return $base;
	}
}
