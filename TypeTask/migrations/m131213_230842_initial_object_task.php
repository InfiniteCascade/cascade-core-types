<?php
namespace cascade\modules\core\TypeTask\migrations;

class m131213_230842_initial_object_task extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_task');
		
		$this->createTable('object_task', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'task' => 'text NOT NULL',
			'start' => 'date DEFAULT NULL',
			'end' => 'date DEFAULT NULL',
			'priority' => 'smallint DEFAULT 0',
			'position' => 'int DEFAULT 0',
			'completed' => 'datetime DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL'
		]);

		$this->addForeignKey('objectTaskRegistry', 'object_task', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_task');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
