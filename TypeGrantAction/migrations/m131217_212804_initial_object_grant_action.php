<?php
namespace cascade\modules\core\TypeGrantAction\migrations;

class m131217_212804_initial_object_grant_action extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_grant_action');
		
		$this->createTable('object_grant_action', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'type' => 'enum(\'stewardship\',\'milestone\') DEFAULT \'stewardship\'',
			'description' => 'text NOT NULL',
			'start' => 'date DEFAULT NULL',
			'end' => 'date DEFAULT NULL',
			'status' => 'enum(\'not_started\',\'in_progress\',\'in_review\',\'submitted\',\'accepted\',\'denied\') DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL'
		]);

		$this->addForeignKey('objectGrantActionRegistry', 'object_grant_action', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_grant_action');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
