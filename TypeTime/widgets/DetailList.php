<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTime\widgets;

use cascade\components\helpers\Html;
/**
 * DetailList [@doctodo write class description for DetailList]
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	/**
	 * @inheritdoc
	 */
	public $pageSize = 8;

	/**
	* @inheritdoc
	 */
	public function contentTemplate($model)
	{
		$template = [
			'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
			'description' => ['class' => 'list-group-item-text'],
			//['parent:Individual' => [], 'parent:_' => []]
		];
		$row = ['settings' => ['class' => 'expanded-only list-group-label-block']];
		$context = $this->getContext();
		$row[] = function($widget, $model, $settings) {
			$parts = [];
            $parent = null;
            foreach ($model->objectTypeItem->parents as $parentRelationship) {
                if ($parentRelationship->parent->systemId === 'Individual') { continue; }
                if ($parentRelationship->parent->systemId === 'Invoice') { continue; }
                $parent = $model->getForeignField('parent:'. $parentRelationship->parent->systemId, [], $this->getContext());
                if (!empty($parent)) {
                    break;
                }
            }
            if (!empty($parent)) {
                $parts[] = Html::tag('span', $parent->model->objectType->title->upperSingular, ['class' => 'list-group-sub-label']);
                $parts[] = Html::tag('span', $parent->model->viewLink, ['class' => 'list-group-sub-value']);
            } else {
    			$parts[] = Html::tag('span', 'Contributor', ['class' => 'list-group-sub-label']);
    			$contributor = $widget->getItemFieldValue($model, 'parent:Individual:viewLink:contributor', []);
    			if (empty($contributor)) {
    				$parts[] = Html::tag('span', '<span class="empty">no one</span>', ['class' => 'list-group-sub-value']);
    			} else {
    				$parts[] = Html::tag('span', $contributor, ['class' => 'list-group-sub-value']);
    			}
            }
			return implode($parts);
		};
		if (!isset($context['relation']) || !in_array('parent:Invoice', $context['relation'])) {
	    	$row[] = function($widget, $model, $settings) {
				$parts = [];
	            $parts[] = Html::tag('span', 'Invoice', ['class' => 'list-group-sub-label']);
				$invoice = $widget->getItemFieldValue($model, 'parent:Invoice:viewLink', []);
				if (empty($invoice)) {
					$parts[] = Html::tag('span', '<span class="empty">none</span>', ['class' => 'list-group-sub-value']);
				} else {
					$parts[] = Html::tag('span', $invoice, ['class' => 'list-group-sub-value']);
				}
				return implode($parts);
			};
		} else {
			$row[] = function($widget, $model, $settings) {
				$parts = [];
	            $parts[] = Html::tag('span', 'Contributor', ['class' => 'list-group-sub-label']);
				$contributor = $widget->getItemFieldValue($model, 'parent:Individual:viewLink:contributor', []);
				if (empty($contributor)) {
					$parts[] = Html::tag('span', '<span class="empty">none</span>', ['class' => 'list-group-sub-value']);
				} else {
					$parts[] = Html::tag('span', $contributor, ['class' => 'list-group-sub-value']);
				}
				return implode($parts);
			};
		}

		$template[] = $row;
		if ($model->can('read')) {
			return $template;
		} else {
			return [
				'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
			];
		}
	}


	/**
	* @inheritdoc
	 */
	public function getWidgetAreas()
	{
		return [
			[
				'class' => 'cascade\modules\core\TypeTime\widgets\SummaryWidget'
			]
		];
	}
}
