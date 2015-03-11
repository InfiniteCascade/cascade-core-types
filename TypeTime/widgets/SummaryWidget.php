<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeTime\widgets;

use teal\helpers\ArrayHelper;
use Yii;

/**
 * SummaryWidget [[@doctodo class_description:cascade\modules\core\TypeTime\widgets\SummaryWidget]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class SummaryWidget extends \cascade\components\web\widgets\base\WidgetArea
{
    /**
     * @inheritdoc
     */
    public $defaultDecoratorClass = 'cascade\components\web\widgets\decorator\BlankDecorator';
    /**
     * @var [[@doctodo var_type:_stats]] [[@doctodo var_description:_stats]]
     */
    protected $_stats;
    /**
     * @inheritdoc
     */
    public $location = 'right';

    /**
     * Get grid cell settings.
     *
     * @return [[@doctodo return_type:getGridCellSettings]] [[@doctodo return_description:getGridCellSettings]]
     */
    public function getGridCellSettings()
    {
        return [
            'columns' => 5,
            'maxColumns' => 6,
            'htmlOptions' => ['class' => 'no-left-padding'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getIsReady()
    {
        return !empty($this->stats['total']);
    }

    /**
     * Get stats.
     *
     * @return [[@doctodo return_type:getStats]] [[@doctodo return_description:getStats]]
     */
    public function getStats()
    {
        if (is_null($this->_stats)) {
            $this->_stats = $this->module->getStats(Yii::$app->request->object);
        }

        return $this->_stats;
    }

    /**
     * @inheritdoc
     */
    public function generateContent()
    {
        if (!empty($this->stats['total'])) {
            return $this->render('summary', ['stats' => $this->stats]);
        }

        return false;
    }

    /**
     * Get module.
     *
     * @return [[@doctodo return_type:getModule]] [[@doctodo return_description:getModule]]
     */
    public function getModule()
    {
        $method = ArrayHelper::getValue($this->parentWidget->settings, 'queryRole', 'all');
        $relationship = ArrayHelper::getValue($this->parentWidget->settings, 'relationship', false);
        if ($method === 'children') {
            return $relationship->child;
        } elseif ($method === 'parents') {
            return $relationship->parent;
        }

        return false;
    }
}
