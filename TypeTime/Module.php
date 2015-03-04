<?php
/**
 * @link http://www.infinitecascade.com/
 *
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTime;

use cascade\components\types\Relationship;
use cascade\models\Registry;
use cascade\models\Relation;
use cascade\models\RelationTaxonomy;
use infinite\base\language\Noun;
use infinite\caching\Cacher;
use infinite\db\Query;
use Yii;
use yii\caching\DbDependency;

/**
 * Module [@doctodo write class description for Module].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Tracked Time';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-clock-o';
    /**
     * @inheritdoc
     */
    public $uniparental = false;
    /**
     * @inheritdoc
     */
    public $hasDashboard = false;
    /**
     * @inheritdoc
     */
    public $priority = 2400;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeTime\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeTime\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeTime/migrations');
    }

    /**
     * @inheritdoc
     */
    public function widgets()
    {
        return parent::widgets();
    }

    /**
     * @inheritdoc
     */
    public function parents()
    {
        return [
            'Agreement' => [
                'type' => Relationship::HAS_ONE,
            ],
            'Project' => [],
            'Individual' => [],
            'Invoice' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function children()
    {
        return [
            'File' => [],
            'Note' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function taxonomies()
    {
        return [
            [
                'name' => 'Individual Role',
                'models' => [\cascade\models\Relation::className()],
                'modules' => [self::className()],
                'systemId' => 'ic_time_individual_role',
                'systemVersion' => 1.0,
                'multiple' => false,
                'parentUnique' => true,
                'required' => true,
                'initialTaxonomies' => [
                    'contributor' => 'Contributor',
                    'requestor' => 'Requestor',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        if (!is_object($this->_title)) {
            $this->_title = new Noun($this->_title, ['plural' => $this->_title]);
        }

        return $this->_title;
    }

    /**
     * Get stats.
     */
    public function getStats($parentObject, $options = [])
    {
        $cacheKey = [__CLASS__ . '.' . __FUNCTION__, 'parentObject' => $parentObject->primaryKey, 'options' => $options, 'context' => ['user']];
        $stats = Cacher::get($cacheKey);
        if (!$stats) {
            $cacheDependency = $this->getCachingDependency($parentObject);
            $stats = [];
            $stats['total'] = $this->getTotalHours($parentObject, $options);
            if ($parentObject->modelAlias !== ':Individual\\ObjectIndividual') {
                $stats['top_contributors'] = $this->getTopContributors($parentObject, $options);
            } else {
                $stats['top_contributions'] = $this->getTopContributions($parentObject, $options);
            }
            $stats['month_summary'] = $this->getMonthSummary($parentObject, $options);
            Cacher::set($cacheKey, $stats, 0, $cacheDependency);
        }

        return $stats;
    }

    /**
     * Get month summary.
     */
    public function getMonthSummary($parentObject, $options = [])
    {
        $limit = isset($options['limit_months']) ? $options['limit_months'] : 5;
        $query = $this->getBaseStatsQuery($parentObject);
        $query->select(['DATE_FORMAT(log_date, \'%Y-%m\') as month', 'SUM(`hours`) as sum']);
        $query->groupBy(['YEAR(log_date)', 'MONTH(log_date)']);
        $query->addOrderBy(['log_date' => SORT_DESC]);
        $query->limit($limit);
        $c = [];
        foreach ($query->each() as $row) {
            $c[$row['month']] = [
                'sum' => $row['sum'],
            ];
        }

        return $c;
    }

    /**
     * Get top contributors.
     */
    public function getTopContributors($parentObject, $options = [])
    {
        $individualType = Yii::$app->collectors['types']->getOne('Individual')->object;
        $individualModelClass = $individualType->primaryModel;
        $individualModelAlias = $individualModelClass::modelAlias();
        $taxonomyType = Yii::$app->collectors['taxonomies']->getOne('ic_time_individual_role');
        $taxonomy = $taxonomyType->getTaxonomy('contributor');
        $limit = isset($options['limit_contributors']) ? $options['limit_contributors'] : 5;
        $query = $this->getBaseStatsQuery($parentObject);
        $query->join('LEFT JOIN', Relation::tableName() . ' r2', 'r2.child_object_id=innerQuery.id');
        $query->join('LEFT JOIN', Registry::tableName() . ' reg', 'r2.parent_object_id=reg.id');
        $query->join('LEFT JOIN', RelationTaxonomy::tableName() . ' tax', 'r2.id=tax.relation_id');
        $query->select(['r2.parent_object_id', 'SUM(`hours`) as sum']);
        $query->groupBy(['r2.parent_object_id']);
        $query->andWhere(['reg.object_model' => $individualModelAlias]);
        $query->andWhere(['tax.taxonomy_id' => $taxonomy->primaryKey]);
        $query->addOrderBy(['SUM(`hours`)' => SORT_DESC]);
        $query->limit($limit);
        $c = [];
        foreach ($query->each() as $row) {
            $individual = Registry::getObject($row['parent_object_id']);
            if (!$individual) {
                continue;
            }
            $c[$row['parent_object_id']] = [
                'label' => $individual->descriptor,
                'sum' => $row['sum'],
            ];
        }

        return $c;
    }

    /**
     * Get top contributions.
     */
    public function getTopContributions($parentObject, $options = [])
    {
        // $individualType = Yii::$app->collectors['types']->getOne('Individual')->object;
        // $individualModelClass = $individualType->primaryModel;
        // $individualModelAlias = $individualModelClass::modelAlias();
        // $taxonomyType = Yii::$app->collectors['taxonomies']->getOne('ic_time_individual_role');
        // $taxonomy = $taxonomyType->getTaxonomy('contributor');
        // $limit = isset($options['limit_contributors']) ? $options['limit_contributors'] : 5;
        // $query = $this->getBaseStatsQuery($parentObject);
        // $query->join('LEFT JOIN', Relation::tableName() . ' r2', 'r2.child_object_id=innerQuery.id');
        // $query->join('LEFT JOIN', Registry::tableName() . ' reg', 'r2.parent_object_id=reg.id');
        // $query->join('LEFT JOIN', RelationTaxonomy::tableName() . ' tax', 'r2.id=tax.relation_id');
        // $query->select(['r2.parent_object_id', 'SUM(`hours`) as sum']);
        // $query->groupBy(['r2.parent_object_id']);
        // $query->andWhere(['not', ['reg.object_model' => $individualModelAlias]]);
        // $query->andWhere(['tax.taxonomy_id' => $taxonomy->primaryKey]);
        // $query->addOrderBy(['SUM(`hours`)' => SORT_DESC]);
        // $query->limit($limit);
        $c = [];
        // echo $query->createCommand()->rawSql;exit;
        // foreach ($query->each() as $row) {
        // 	$individual = Registry::getObject($row['parent_object_id']);
        // 	if (!$individual) { continue; }
        // 	$c[$row['parent_object_id']] = [
        // 		'label' => $individual->descriptor,
        // 		'sum' => $row['sum']
        // 	];
        // }
        return $c;
    }

    /**
     * Get total hours.
     */
    public function getTotalHours($parentObject)
    {
        $query = $this->getBaseStatsQuery($parentObject);
        $query->select(['SUM(`hours`)']);

        return $query->scalar();
    }

    /**
     * Get base stats query.
     */
    public function getBaseStatsQuery($parentObject)
    {
        $baseQuery = $parentObject->queryChildObjects($this->primaryModel);
        $query = new Query();
        $query->from(['(' . $baseQuery->createCommand()->rawSql . ') innerQuery']);

        return $query;
    }

    /**
     * Get caching dependency.
     */
    public function getCachingDependency($parentObject)
    {
        //$primaryModel = $this->primaryModel;
        //$alias = $primaryModel::tableName();
        $baseQuery = $this->getBaseStatsQuery($parentObject);
        $baseQuery->select(['innerQuery.modified']);
        $baseQuery->addOrderBy(['innerQuery.modified' => SORT_DESC]);
        $baseQuery->limit(1);
        $cacheSql = $baseQuery->createCommand()->rawSql;

        return new DbDependency(['sql' => $cacheSql]);
    }
}
