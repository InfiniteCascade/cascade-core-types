<?php
namespace cascade\modules\core\TypeIndividual\migrations;

class m131101_202825_initial_object_individual extends \teal\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_individual');

        $this->createTable('object_individual', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'photo_storage_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'prefix' => 'string(255) DEFAULT NULL',
            'suffix' => 'string(255) DEFAULT NULL',
            'first_name' => 'string(255) NOT NULL',
            'middle_name' => 'string(255) DEFAULT NULL',
            'last_name' => 'string(255) DEFAULT \'\'',
            'title' => 'string(255) DEFAULT NULL',
            'department' => 'string(255) DEFAULT NULL',
            'birthday' => 'date DEFAULT NULL',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'archived' => 'datetime DEFAULT NULL',
            'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
        ]);

        $this->createIndex('objectIndividualCreatedUser', 'object_individual', 'created_user_id', false);
        $this->createIndex('objectIndividualModifiedUser', 'object_individual', 'modified_user_id', false);
        $this->createIndex('objectIndividualArchivedUser', 'object_individual', 'archived_user_id', false);
        $this->createIndex('objectIndividualPhotoStorage', 'object_individual', 'photo_storage_id', false);
        $this->addForeignKey('objectIndividualPhotoStorage', 'object_individual', 'photo_storage_id', 'storage', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('objectIndividualCreatedUser', 'object_individual', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectIndividualArchivedUser', 'object_individual', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectIndividualModfiedUser', 'object_individual', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectIndividualRegistry', 'object_individual', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_individual');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
