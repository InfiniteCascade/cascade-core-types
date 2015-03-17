<?php
namespace cascade\modules\core\TypePostalAddress\migrations;

class m131204_003752_initial_object_postal_address extends \canis\db\Migration
{
    public function up()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();

        $this->dropExistingTable('object_postal_address');

        $this->createTable('object_postal_address', [
            'id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY',
            'name' => 'string(255) DEFAULT NULL',
            'type' => 'enum(\'home\',\'office\',\'other\') DEFAULT NULL',
            'address1' => 'string(255) DEFAULT NULL',
            'address2' => 'string(255) DEFAULT NULL',
            'city' => 'string(255) DEFAULT NULL',
            'subnational_division' => 'string(100) DEFAULT NULL',
            'postal_code' => 'string(20) DEFAULT NULL',
            'country' => 'string(255) DEFAULT NULL',
            'no_mailings' => 'boolean NOT NULL DEFAULT 0',
            'created' => 'datetime DEFAULT NULL',
            'created_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            'modified' => 'datetime DEFAULT NULL',
            'modified_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL',
            // 'archived' => 'datetime DEFAULT NULL',
            // 'archived_user_id' => 'char(36) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL'
        ]);

        $this->addForeignKey('postalAddressRegistry', 'object_postal_address', 'id', 'registry', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('objectPostalAddressCreatedUser', 'object_postal_address', 'created_user_id', false);
        $this->createIndex('objectPostalAddressModifiedUser', 'object_postal_address', 'modified_user_id', false);
        // $this->createIndex('objectPostalAddressArchivedUser', 'object_postal_address', 'archived_user_id', false);
        $this->addForeignKey('objectPostalAddressCreatedUser', 'object_postal_address', 'created_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        // $this->addForeignKey('objectPostalAddressArchivedUser', 'object_postal_address', 'archived_user_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('objectPostalAddressModfiedUser', 'object_postal_address', 'modified_user_id', 'user', 'id', 'SET NULL', 'SET NULL');

        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }

    public function down()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->dropExistingTable('object_postal_address');
        $this->db->createCommand()->checkIntegrity(true)->execute();

        return true;
    }
}
