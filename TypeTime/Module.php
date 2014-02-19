<?php

namespace cascade\modules\core\TypeTime;

use Yii;

use cascade\components\types\Relationship;
use cascade\models\Registry;

use infinite\base\language\Noun;
use infinite\db\Query;
use infinite\caching\Cacher;

use yii\caching\DbDependency;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Tracked Time';
	public $icon = 'fa fa-clock-o';
	public $uniparental = false;
	public $hasDashboard = false;
	public $priority = 2400;

	public $widgetNamespace = 'cascade\modules\core\TypeTime\widgets';
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
			'Project' => [],
			'Individual' => [],
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
		return [];
	}

	public function getTitle() {
		if (!is_object($this->_title)) {
			$this->_title = new Noun($this->_title, ['plural' => $this->_title]);
		}
		return $this->_title;
	}

	public function getStats($parentObject, $options = [])
	{
		$cacheKey = [__CLASS__.'.'.__FUNCTION__, 'parentObject' => $parentObject->primaryKey, 'options' => $options, 'context' => ['user']];
		$stats = Cacher::get($cacheKey);
		if (!$stats) {
			$cacheDependency = $this->getCachingDependency($parentObject);
			$stats = [];
			$stats['total'] = $this->getTotalHours($parentObject, $options);
			if ($parentObject->modelAlias !== ':Individual\\ObjectIndividual') {
				$stats['top_contributors'] = $this->getTopContributors($parentObject, $options);
			}
			$stats['month_summary'] = $this->getMonthSummary($parentObject, $options);
			Cacher::set($cacheKey, $stats, 0, $cacheDependency);
		}
		return $stats;
	}

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
				'sum' => $row['sum']
			];
		}
		return $c;
	}

	public function getTopContributors($parentObject, $options = [])
	{
		$limit = isset($options['limit_contributors']) ? $options['limit_contributors'] : 5;
		$query = $this->getBaseStatsQuery($parentObject);
		$query->select(['contributor_individual_id', 'SUM(`hours`) as sum']);
		$query->groupBy(['contributor_individual_id']);
		$query->addOrderBy(['SUM(`hours`)' => SORT_DESC]);
		$query->limit($limit);
		$c = [];
		foreach ($query->each() as $row) {
			$individual = Registry::getObject($row['contributor_individual_id']);
			if (!$individual) { continue; }
			$c[$row['contributor_individual_id']] = [
				'label' => $individual->descriptor,
				'sum' => $row['sum']
			];
		}
		return $c;
	}


	public function getTotalHours($parentObject)
	{
		$query = $this->getBaseStatsQuery($parentObject);
		$query->select(['SUM(`hours`)']);
		return $query->scalar();
	}

	public function getBaseStatsQuery($parentObject)
	{
		$baseQuery = $parentObject->queryChildObjects($this->primaryModel);
		$query = new Query;
		$query->from(['('. $baseQuery->createCommand()->rawSql .') raw']);
		return $query;
	}

	public function getCachingDependency($parentObject)
	{
		//$primaryModel = $this->primaryModel;
		//$alias = $primaryModel::tableName();
		$baseQuery = $this->getBaseStatsQuery($parentObject);
		$baseQuery->select(['raw.modified']);
		$baseQuery->addOrderBy(['raw.modified' => SORT_DESC]);
		$baseQuery->limit(1);
		$cacheSql = $baseQuery->createCommand()->rawSql;
		return new DbDependency(['sql' => $cacheSql]);
	}
}