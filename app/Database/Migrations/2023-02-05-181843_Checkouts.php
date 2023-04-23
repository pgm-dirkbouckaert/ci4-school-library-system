<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Checkouts extends Migration {

  public function up() {

    $this->forge->addField([
      'book_id'  => [
        'type'           => 'INT',
        'unsigned'       => true,
      ],
      'book_title' => [
        'type'           => 'VARCHAR',
        'constraint' => '255',
      ],
      'member_id'  => [
        'type'           => 'INT',
        'unsigned'       => true,
      ],
      'member_name' => [
        'type'           => 'VARCHAR',
        'constraint' => '255',
      ],
      'created_at' => [
        'type' => 'TIMESTAMP',
      ],
      // 'created_at timestamp default current_timestamp',
    ]);
    $this->forge->addKey('checkout_id', true); //addKey($key[, $primary = false[, $unique = false]])
    $this->forge->createTable('checkouts');
  }

  public function down() {
    $this->forge->dropTable("checkouts");
  }
}
