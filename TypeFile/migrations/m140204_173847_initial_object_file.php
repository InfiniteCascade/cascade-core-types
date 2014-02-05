<?php
namespace cascade\modules\core\TypeFile\migrations;

class m140204_173847_initial_object_file extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_file');
		
		$this->createTable('object_file', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'storage_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL',
			'name' => 'string(255) DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL'
		]);

		$this->createIndex('objectFileStorage', 'object_file', 'storage_id', false);
		$this->addForeignKey('objectFileRegistry', 'object_file', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('objectFileStorage', 'object_file', 'storage_id', 'storage', 'id', 'CASCADE', 'CASCADE');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_file');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
