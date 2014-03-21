<?php
namespace cascade\modules\core\TypeEmailAddress\migrations;

class m131101_212903_initial_object_email_address extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_email_address');
		
		$this->createTable('object_email_address', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'email_address' => 'string(255) NOT NULL',
			'no_mailings' => 'boolean NOT NULL DEFAULT 0',
			'created' => 'datetime DEFAULT NULL',
			'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL',
			'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
			'archived' => 'datetime DEFAULT NULL',
			'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
		]);

		$this->addForeignKey('emailAddressRegistry', 'object_email_address', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
		$this->createIndex('objectEmailAddressCreatedUser', 'object_email_address', 'created_user_id', false);
		$this->createIndex('objectEmailAddressModifiedUser', 'object_email_address', 'modified_user_id', false);
		$this->createIndex('objectEmailAddressArchivedUser', 'object_email_address', 'archived_user_id', false);
		$this->addForeignKey('objectEmailAddressCreatedUser', 'object_email_address', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectEmailAddressArchivedUser', 'object_email_address', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('objectEmailAddressModfiedUser', 'object_email_address', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_email_address');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
