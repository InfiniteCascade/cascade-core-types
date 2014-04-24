<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTask\widgets;

use Yii;
use cascade\components\helpers\Html;

/**
 * DetailList [@doctodo write class description for DetailList]
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public function getAssetBundles()
    {
        return array_merge(parent::getAssetBundles(), [
        	'cascade\\modules\\core\\TypeTask\\widgets\\TaskAsset'
        ]);
    }

	public function renderItemContent($model, $key, $index)
    {
    	$descriptorContent = parent::renderItemContent($model, $key, $index);
        $parts = [];
        $parts[] = Html::beginTag('div', ['class' => 'ic-task-item row']);
        $parts[] = Html::beginTag('div', ['class' => 'col-xs-1']);
        $fields = $model->getFields();
        $radioOptions = [];
        $relatedObject = null;
        if (isset(Yii::$app->request->object) && Yii::$app->request->object->primaryKey !== $model->primaryKey) {
        	$relatedObject = Yii::$app->request->object;
        }

        if (!$model->can('update')) {
        	$radioOptions['disabled'] = true;
        } elseif (!Html::prepareEditInPlace($radioOptions, $model, 'completedStatus', $relatedObject)) {
        	$radioOptions['disabled'] = true;
        }
        $radioOptions['uncheckedValue'] = 0;
        $parts[] = Html::checkbox($fields['completedStatus']->formField->getModelFieldName(), !empty($model->completed), $radioOptions);
        $parts[] = Html::endTag('div');
        $parts[] = Html::beginTag('div', ['class' => 'col-xs-10']);
        $parts[] = $descriptorContent;
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('div');
        return implode("", $parts);
    }
}
