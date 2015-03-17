<?php
namespace cascade\modules\core\TypeGrant\migrations;

class m131217_212804_initial_object_grant extends \canis\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_grant');

        $this->createTable('object_grant', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'title' => 'string(255) NOT NULL',
            'description' => 'text NOT NULL',
            'determination' => 'date DEFAULT NULL',
            'start' => 'date DEFAULT NULL',
            'end' => 'date DEFAULT NULL',
            'status' => 'enum(\'development\',\'internal_review\',\'submitted\',\'awarded\', \'denied\', \'deferred\') DEFAULT NULL',
            'ask' => 'decimal(11,2) DEFAULT NULL',
            'award' => 'decimal(11,2) DEFAULT NULL',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'archived' => 'datetime DEFAULT NULL',
            'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
        ]);

        $this->addForeignKey('objectGrantRegistry', 'object_grant', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectGrantCreatedUser', 'object_grant', 'created_user_id', false);
        $this->createIndex('objectGrantModifiedUser', 'object_grant', 'modified_user_id', false);
        $this->createIndex('objectGrantArchivedUser', 'object_grant', 'archived_user_id', false);
        $this->addForeignKey('objectGrantCreatedUser', 'object_grant', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectGrantArchivedUser', 'object_grant', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectGrantModfiedUser', 'object_grant', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_grant');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
