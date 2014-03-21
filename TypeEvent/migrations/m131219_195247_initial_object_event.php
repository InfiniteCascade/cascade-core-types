<?php
namespace cascade\modules\core\TypeEvent\migrations;

class m131219_195247_initial_object_event extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_event');
		
		$this->createTable('object_event', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'name' => 'string(255) NOT NULL DEFAULT \'\'',
			'description' => 'text DEFAULT NULL',
			'start' => 'date DEFAULT NULL',
			'end' => 'date DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL',
			'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'archived' => 'datetime DEFAULT NULL',
			'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
		]);

		$this->addForeignKey('objectEventRegistry', 'object_event', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
		$this->createIndex('objectEventCreatedUser', 'object_event', 'created_user_id', false);
		$this->createIndex('objectEventModifiedUser', 'object_event', 'modified_user_id', false);
		$this->createIndex('objectEventArchivedUser', 'object_event', 'archived_user_id', false);
		$this->addForeignKey('objectEventCreatedUser', 'object_event', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectEventArchivedUser', 'object_event', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectEventModfiedUser', 'object_event', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_event');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
