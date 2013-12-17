<?php
namespace cascade\modules\core\TypeActivity\migrations;

class m131217_212804_initial_object_activity extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_activity');
		
		$this->createTable('object_activity', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'summary' => 'string(255) NOT NULL',
			'details' => 'text DEFAULT NULL',
			'start' => 'date DEFAULT NULL',
			'end' => 'date DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL'
		]);

		$this->addForeignKey('objectActivityRegistry', 'object_activity', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_activity');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
