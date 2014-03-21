<?php
namespace cascade\modules\core\TypeWebAddress\migrations;

class m131204_024302_initial_object_web_address extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_web_address');
		
		$this->createTable('object_web_address', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'title' => 'string(255) DEFAULT NULL',
			'url' => 'string(500) NOT NULL',
			'created' => 'datetime DEFAULT NULL',
			'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL',
			'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'archived' => 'datetime DEFAULT NULL',
			'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
		]);

		$this->addForeignKey('objectUrlRegistry', 'object_web_address', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
		$this->createIndex('objectWebAddressCreatedUser', 'object_web_address', 'created_user_id', false);
		$this->createIndex('objectWebAddressModifiedUser', 'object_web_address', 'modified_user_id', false);
		$this->createIndex('objectWebAddressArchivedUser', 'object_web_address', 'archived_user_id', false);
		$this->addForeignKey('objectWebAddressCreatedUser', 'object_web_address', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectWebAddressArchivedUser', 'object_web_address', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectWebAddressModfiedUser', 'object_web_address', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_web_address');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
