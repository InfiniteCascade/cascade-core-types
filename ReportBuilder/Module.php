<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\ReportBuilder;

use cascade\components\reports\Module as ReportModule;

/**
 * Module [[@doctodo class_description:cascade\modules\core\ReportTime\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends ReportModule
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Report Builder';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-clock-o';

    public function getDescription() {
        return 'Powerful report builder';
    }

    public function getObjectTypes() {
        $types = [];
        foreach (Yii::$app->collectors['types']->getAll() as $typeItem) {
            if (!$typeItem->object) { continue; }
            if ($typeItem->object instanceof ReportBuilderInterface) {
                $types[] = $typeItem->systemId;
            }
        }
        return $types;
    }

    public function getVariations()
    {
        $variations = [];
        foreach ($this->objectTypes as $typeId) {
            $typeItem = Yii::$app->collectors['types']->getById($typeId);
            $variations[$typeId] = [
                'icon' => $typeItem->object->icon,
                'title' => $typeItem->object->title->upperSingular,
                'description' => 'Run a report on ' . $typeItem->object->title->plural,
                'params' => ['type' => $typeId]
            ];
        }
        return $variations;
    }

}
