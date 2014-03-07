<?php
namespace cascade\modules\core\TypeInvoice\migrations;

class m131217_212804_initial_object_invoice extends \infinite\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();

		$this->dropExistingTable('object_invoice');
		
		$this->createTable('object_invoice', [
			'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
			'number' => 'string(40) DEFAULT NULL',
			'revenue' => 'decimal(11,2) DEFAULT NULL',
			'start' => 'date DEFAULT NULL',
			'end' => 'date DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'modified' => 'datetime DEFAULT NULL'
		]);

		$this->addForeignKey('objectInvoiceRegistry', 'object_invoice', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

		$this->db->createCommand()->checkIntegrity(true)->execute();

		return true;
	}



	public function down()
	{
		$this->db->createCommand()->checkIntegrity(false)->execute();
		$this->dropExistingTable('object_invoice');
		$this->db->createCommand()->checkIntegrity(true)->execute();
		return true;
	}
}
