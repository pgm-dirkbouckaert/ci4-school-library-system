<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Members extends Migration {

  public function up() {

    $this->forge->addField([
      'member_id'          => [
        'type'           => 'INT',
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'status' => [
        'type'    => 'ENUM("active", "suspended")',
        'default' => 'active',
      ],
      'name'       => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'email'       => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'phone' => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'address' => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'current_checkouts' => [
        'type'       => 'INT',
        'constraint' => '3',
      ],
      'img' => [
        'type' => 'VARCHAR',
        'constraint' => '255',
      ],
      'created_at' => [
        'type' => 'TIMESTAMP',
      ],
    ]);
    $this->forge->addKey('member_id', true); //addKey($key[, $primary = false[, $unique = false]])
    $this->forge->createTable('members');
  }

  public function down() {
    $this->forge->dropTable('members');
  }
}
