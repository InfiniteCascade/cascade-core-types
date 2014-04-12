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
			'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL',
			'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			// 'archived' => 'datetime DEFAULT NULL',
			// 'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
		]);

		$this->addForeignKey('objectGrantActionRegistry', 'object_grant_action', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
		$this->createIndex('objectGrantActionCreatedUser', 'object_grant_action', 'created_user_id', false);
		$this->createIndex('objectGrantActionModifiedUser', 'object_grant_action', 'modified_user_id', false);
		// $this->createIndex('objectGrantActionArchivedUser', 'object_grant_action', 'archived_user_id', false);
		$this->addForeignKey('objectGrantActionCreatedUser', 'object_grant_action', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		// $this->addForeignKey('objectGrantActionArchivedUser', 'object_grant_action', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectGrantActionModfiedUser', 'object_grant_action', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

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
