<?php
namespace cascade\modules\core\TypeAgreement\migrations;

class m131217_212804_initial_object_agreement extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_agreement');
		
		$this->createTable('object_agreement', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'number' => 'string(25) DEFAULT NULL',
			'title' => 'string(200) NOT NULL',
			'description' => 'text NOT NULL',
			'start' => 'date DEFAULT NULL',
			'end' => 'date DEFAULT NULL',
			'billable' => 'enum(\'a\',\'m\',\'q\',\'fq\',\'fa\',\'req\') DEFAULT NULL',
			'hours' => 'decimal(11,2) DEFAULT NULL',
			'revenue' => 'decimal(11,2) DEFAULT NULL',
			'cost' => 'decimal(11,2) DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL'
		]);

		$this->addForeignKey('objectAgreementRegistry', 'object_agreement', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_agreement');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
