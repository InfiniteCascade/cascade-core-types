<?php
namespace cascade\modules\core;

use Yii;

class Extension extends \cascade\components\base\ModuleSetExtension {
	public static function init()
	{
		parent::init();
		Yii::setAlias('@cascade/modules/core', __DIR__);
	}

	public static function getModules()
	{
		$m = [];
		$m['TypeAccount'] = [
			'class' => 'cascade\\modules\\core\\TypeAccount\\Module'
		];
		$m['TypeIndividual'] = [
			'class' => 'cascade\\modules\\core\\TypeIndividual\\Module'
		];
		$m['TypePostalAddress'] = [
			'class' => 'cascade\\modules\\core\\TypePostalAddress\\Module'
		];
		$m['TypePhoneNumber'] = [
			'class' => 'cascade\\modules\\core\\TypePhoneNumber\\Module'
		];
		$m['TypeEmailAddress'] = [
			'class' => 'cascade\\modules\\core\\TypeEmailAddress\\Module'
		];
		$m['TypeWebAddress'] = [
			'class' => 'cascade\\modules\\core\\TypeWebAddress\\Module'
		];
		$m['TypeFile'] = [
			'class' => 'cascade\\modules\\core\\TypeFile\\Module'
		];
		$m['TypeNote'] = [
			'class' => 'cascade\\modules\\core\\TypeNote\\Module'
		];
		$m['TypeProject'] = [
			'class' => 'cascade\\modules\\core\\TypeProject\\Module'
		];
		$m['TypeTaskSet'] = [
			'class' => 'cascade\\modules\\core\\TypeTaskSet\\Module'
		];
		$m['TypeTime'] = [
			'class' => 'cascade\\modules\\core\\TypeTime\\Module'
		];
		$m['TypeGrant'] = [
			'class' => 'cascade\\modules\\core\\TypeGrant\\Module'
		];
		$m['TypeGrantAction'] = [
			'class' => 'cascade\\modules\\core\\TypeGrantAction\\Module'
		];
		$m['TypeAgreement'] = [
			'class' => 'cascade\\modules\\core\\TypeAgreement\\Module'
		];
		$m['TypeInvoice'] = [
			'class' => 'cascade\\modules\\core\\TypeInvoice\\Module'
		];
		$m['TypeActivity'] = [
			'class' => 'cascade\\modules\\core\\TypeActivity\\Module'
		];
		return $m;
	}
}