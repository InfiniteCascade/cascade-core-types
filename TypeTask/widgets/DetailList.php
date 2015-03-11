<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeTask\widgets;

use cascade\components\helpers\Html;
use Yii;

/**
 * DetailList [[@doctodo class_description:cascade\modules\core\TypeTask\widgets\DetailList]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
    /**
     * @inheritdoc
     */
    public function getAssetBundles()
    {
        return array_merge(parent::getAssetBundles(), [
            'cascade\modules\core\TypeTask\widgets\TaskAsset',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function contentTemplate($model)
    {
        $contentTemplate = [
            'descriptor' => ['class' => 'list-group-item-heading expanded-pre', 'tag' => 'h5'],
        ];
        $contentTemplate[] = [
            'settings' => ['class' => 'expanded-only list-group-label-block'],
            function ($widget, $model, $settings) {
                $parts = [];
                $parent = null;
                foreach ($model->objectTypeItem->parents as $parentRelationship) {
                    if ($parentRelationship->parent->systemId === 'Individual') {
                        continue;
                    }
                    $parent = $model->getForeignField('parent:' . $parentRelationship->parent->systemId, [], $this->getContext());
                    if (!empty($parent)) {
                        break;
                    }
                }
                if (!empty($parent)) {
                    $parts[] = Html::tag('span', $parent->model->objectType->title->upperSingular, ['class' => 'list-group-sub-label']);
                    $parts[] = Html::tag('span', $parent->model->viewLink, ['class' => 'list-group-sub-value']);
                } else {
                    $parts[] = Html::tag('span', 'Assigned To', ['class' => 'list-group-sub-label']);
                    $assigned = $widget->getItemFieldValue($model, 'parent:Individual:viewLink:assignee', []);
                    if (empty($assigned)) {
                        $parts[] = Html::tag('span', '<span class="empty">no one</span>', ['class' => 'list-group-sub-value']);
                    } else {
                        $parts[] = Html::tag('span', $assigned, ['class' => 'list-group-sub-value']);
                    }
                }

                return implode($parts);
            },
            function ($widget, $model, $settings) {
                $parts = [];
                $parts[] = Html::tag('span', 'Deferred Date', ['class' => 'list-group-sub-label']);
                if (empty($model->start)) {
                    $parts[] = Html::tag('span', '<span class="empty">none set</span>', ['class' => 'list-group-sub-value']);
                } else {
                    $parts[] = Html::tag('span', $model->start, ['class' => 'list-group-sub-value']);
                }

                return implode($parts);
            },
            function ($widget, $model, $settings) {
                $parts = [];
                $parts[] = Html::tag('span', 'Due Date', ['class' => 'list-group-sub-label']);
                $valueOptions = ['class' => 'list-group-sub-value'];
                if ($model->isDueToday()) {
                    Html::addCssClass($valueOptions, 'text-warning');
                } elseif ($model->isPassedDue()) {
                    Html::addCssClass($valueOptions, 'text-danger');
                }
                if (empty($model->end)) {
                    $parts[] = Html::tag('span', '<span class="empty">none set</span>', ['class' => 'list-group-sub-value']);
                } else {
                    $parts[] = Html::tag('span', $model->end, $valueOptions);
                }

                return implode($parts);
            },
        ];

        return $contentTemplate;
    }

    /**
     * @inheritdoc
     */
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
        $title = 'Task has not been completed';
        if (!empty($model->completed)) {
            $title = 'Task was completed on ' . $model->completed;
        }
        $radioOptions['title'] = $title;
        Html::addCssClass($radioOptions, 'taskCompletedStatus');
        $parts[] = Html::checkbox($fields['completedStatus']->formField->getModelFieldName(), !empty($model->completedStatus), $radioOptions);
        $parts[] = Html::endTag('div');
        $parts[] = Html::beginTag('div', ['class' => 'col-xs-10 expandable-child']);
        $parts[] = $descriptorContent;
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('div');

        return implode("", $parts);
    }
}
