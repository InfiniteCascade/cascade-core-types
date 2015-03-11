<?php
namespace cascade\modules\core\TypeNote\migrations;

class m131213_230842_initial_object_note extends \teal\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_note');

        $this->createTable('object_note', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'title' => 'string(255) DEFAULT NULL',
            'note' => 'text DEFAULT NULL',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            // 'archived' => 'datetime DEFAULT NULL',
            // 'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
        ]);

        $this->addForeignKey('objectNoteRegistry', 'object_note', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectNoteCreatedUser', 'object_note', 'created_user_id', false);
        $this->createIndex('objectNoteModifiedUser', 'object_note', 'modified_user_id', false);
        // $this->createIndex('objectNoteArchivedUser', 'object_note', 'archived_user_id', false);
        $this->addForeignKey('objectNoteCreatedUser', 'object_note', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        // $this->addForeignKey('objectNoteArchivedUser', 'object_note', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectNoteModfiedUser', 'object_note', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_note');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
