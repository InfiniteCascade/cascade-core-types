<?php
namespace cascade\modules\core\TypeFile\migrations;

class m140204_173847_initial_object_file extends \canis\db\Migration
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
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            //'archived' => 'datetime DEFAULT NULL',
            //'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
        ]);

        $this->createIndex('objectFileStorage', 'object_file', 'storage_id', false);
        $this->addForeignKey('objectFileRegistry', 'object_file', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('objectFileStorage', 'object_file', 'storage_id', 'storage', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectFileCreatedUser', 'object_file', 'created_user_id', false);
        $this->createIndex('objectFileModifiedUser', 'object_file', 'modified_user_id', false);
        // $this->createIndex('objectFileArchivedUser', 'object_file', 'archived_user_id', false);
        $this->addForeignKey('objectFileCreatedUser', 'object_file', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        // $this->addForeignKey('objectFileArchivedUser', 'object_file', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectFileModfiedUser', 'object_file', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

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
