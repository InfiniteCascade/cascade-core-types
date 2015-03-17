<?php
namespace cascade\modules\core\TypeAccount\migrations;

class m131101_193522_initial_object_account extends \canis\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_account');

        $this->createTable('object_account', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'photo_storage_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'name' => 'string(255) NOT NULL',
            'alt_name' => 'string(255) DEFAULT NULL',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'archived' => 'datetime DEFAULT NULL',
            'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
        ]);

        $this->createIndex('objectAccountCreatedUser', 'object_account', 'created_user_id', false);
        $this->createIndex('objectAccountModifiedUser', 'object_account', 'modified_user_id', false);
        $this->createIndex('objectAccountArchivedUser', 'object_account', 'archived_user_id', false);
        $this->createIndex('objectAccountPhotoStorage', 'object_account', 'photo_storage_id', false);
        $this->addForeignKey('objectAccountPhotoStorage', 'object_account', 'photo_storage_id', 'storage', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('objectAccountCreatedUser', 'object_account', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectAccountArchivedUser', 'object_account', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectAccountModfiedUser', 'object_account', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectAccountRegistry', 'object_account', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_account');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
