<?php
namespace cascade\modules\core\TypeTime\migrations;

class m131213_230842_initial_object_time extends \canis\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_time');

        $this->createTable('object_time', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'description' => 'text DEFAULT NULL',
            'hours' => 'decimal(10,2) NOT NULL DEFAULT \'0.00\'',
            'billable' => 'boolean DEFAULT 0',
            'log_date' => 'date DEFAULT NULL',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            // 'archived' => 'datetime DEFAULT NULL',
            // 'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
        ]);

        $this->addForeignKey('objectTimeRegistry', 'object_time', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectTimeCreatedUser', 'object_time', 'created_user_id', false);
        $this->createIndex('objectTimeModifiedUser', 'object_time', 'modified_user_id', false);
        // $this->createIndex('objectTimeArchivedUser', 'object_time', 'archived_user_id', false);
        $this->addForeignKey('objectTimeCreatedUser', 'object_time', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        // $this->addForeignKey('objectTimeArchivedUser', 'object_time', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectTimeModfiedUser', 'object_time', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_time');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
