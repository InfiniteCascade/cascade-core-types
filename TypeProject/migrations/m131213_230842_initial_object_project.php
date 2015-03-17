<?php
namespace cascade\modules\core\TypeProject\migrations;

class m131213_230842_initial_object_project extends \canis\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_project');

        $this->createTable('object_project', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'title' => 'string(255) NOT NULL',
            'description' => 'text DEFAULT NULL',
            'start' => 'date DEFAULT NULL',
            'end' => 'date DEFAULT NULL',
            'active' => 'boolean NOT NULL DEFAULT 1',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'archived' => 'datetime DEFAULT NULL',
            'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
        ]);

        $this->addForeignKey('projectRegistry', 'object_project', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectProjectCreatedUser', 'object_project', 'created_user_id', false);
        $this->createIndex('objectProjectModifiedUser', 'object_project', 'modified_user_id', false);
        $this->createIndex('objectProjectArchivedUser', 'object_project', 'archived_user_id', false);
        $this->addForeignKey('objectProjectCreatedUser', 'object_project', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectProjectArchivedUser', 'object_project', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectProjectModfiedUser', 'object_project', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_project');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
