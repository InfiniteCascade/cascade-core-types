<?php
/**
 * @link http://psesd.org/
 *
 * @copyright Copyright (c) 2015 Puget Sound ESD
 * @license http://psesd.org/license/
 */

namespace cascade\modules\core\TypeAgreement\widgets;

/**
 * DetailList [[@doctodo class_description:cascade\modules\core\TypeAgreement\widgets\DetailList]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
    public function getSortBy()
    {
        $dummyModel = $this->owner->dummyModel;
        $descriptorField = $dummyModel->descriptorField;
        if (is_array($descriptorField)) {
            $descriptorLabel = $dummyModel->getAttributeLabel('descriptor');
        } else {
            $descriptorLabel = $dummyModel->getAttributeLabel($descriptorField);
        }
        $alias = $dummyModel->tableName();
        $defaultOrder = $dummyModel->getDefaultOrder($alias);

        $sortBy = parent::getSortBy();
        $sortBy['start'] = [
            'label' => $dummyModel->getAttributeLabel('start'),
            'asc' => array_merge([$alias . '.[[start]]' => SORT_ASC], $defaultOrder),
            'desc' => array_merge([$alias . '.[[start]]' => SORT_DESC], $defaultOrder),
        ];
        $sortBy['end'] = [
            'label' => $dummyModel->getAttributeLabel('end'),
            'asc' => array_merge([$alias . '.[[end]]' => SORT_ASC], $defaultOrder),
            'desc' => array_merge([$alias . '.[[end]]' => SORT_DESC], $defaultOrder),
        ];
        $sortBy['cost'] = [
            'label' => $dummyModel->getAttributeLabel('cost'),
            'asc' => array_merge([$alias . '.[[cost]]' => SORT_ASC], $defaultOrder),
            'desc' => array_merge([$alias . '.[[cost]]' => SORT_DESC], $defaultOrder),
        ];
        $sortBy['revenue'] = [
            'label' => $dummyModel->getAttributeLabel('revenue'),
            'asc' => array_merge([$alias . '.[[revenue]]' => SORT_ASC], $defaultOrder),
            'desc' => array_merge([$alias . '.[[revenue]]' => SORT_DESC], $defaultOrder),
        ];
        $sortBy['number'] = [
            'label' => $dummyModel->getAttributeLabel('number'),
            'asc' => array_merge([$alias . '.[[number]]' => SORT_ASC], $defaultOrder),
            'desc' => array_merge([$alias . '.[[number]]' => SORT_DESC], $defaultOrder),
        ];
        return $sortBy;
    }

    public function getCurrentSortBy()
    {
        return $this->getState('sortBy', 'start');
    }

    public function getCurrentSortByDirection()
    {
        return $this->getState('sortByDirection', 'desc');
    }
}
