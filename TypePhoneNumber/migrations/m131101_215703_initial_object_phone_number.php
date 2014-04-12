<?php
namespace cascade\modules\core\TypePhoneNumber\migrations;

class m131101_215703_initial_object_phone_number extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_phone_number');
		
		$this->createTable('object_phone_number', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'phone' => 'string(100) NOT NULL',
			'extension' => 'string(15) DEFAULT NULL',
			'no_call' => 'boolean NOT NULL DEFAULT 0',
			'created' => 'datetime DEFAULT NULL',
			'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL',
			'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			// 'archived' => 'datetime DEFAULT NULL',
			// 'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
		]);

		$this->addForeignKey('phoneRegistry', 'object_phone_number', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
		$this->createIndex('objectPhoneNumberCreatedUser', 'object_phone_number', 'created_user_id', false);
		$this->createIndex('objectPhoneNumberModifiedUser', 'object_phone_number', 'modified_user_id', false);
		// $this->createIndex('objectPhoneNumberArchivedUser', 'object_phone_number', 'archived_user_id', false);
		$this->addForeignKey('objectPhoneNumberCreatedUser', 'object_phone_number', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		// $this->addForeignKey('objectPhoneNumberArchivedUser', 'object_phone_number', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectPhoneNumberModfiedUser', 'object_phone_number', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_phone_number');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
