<?php
namespace cascade\modules\core\TypeInvoice\migrations;

class m131217_212804_initial_object_invoice extends \teal\db\Migration
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
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'archived' => 'datetime DEFAULT NULL',
            'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
        ]);

        $this->addForeignKey('objectInvoiceRegistry', 'object_invoice', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectInvoiceCreatedUser', 'object_invoice', 'created_user_id', false);
        $this->createIndex('objectInvoiceModifiedUser', 'object_invoice', 'modified_user_id', false);
        $this->createIndex('objectInvoiceArchivedUser', 'object_invoice', 'archived_user_id', false);
        $this->addForeignKey('objectInvoiceCreatedUser', 'object_invoice', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectInvoiceArchivedUser', 'object_invoice', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectInvoiceModfiedUser', 'object_invoice', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

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
