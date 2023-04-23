<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Collections extends Migration {

  public function up() {

    $this->forge->addField([
      'collection_id'  => [
        'type'           => 'INT',
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'name' => [
        'type'           => 'VARCHAR',
        'constraint' => '255',
      ],
      'location'       => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'number_of_books'       => [
        'type'       => 'INT',
        'unsigned'       => true,
      ],
      'created_at' => [
        'type' => 'TIMESTAMP',
      ],
    ]);
    $this->forge->addKey('collection_id', true); //addKey($key[, $primary = false[, $unique = false]])
    $this->forge->createTable('collections');
  }

  public function down() {
    $this->forge->dropTable('collections');
  }
}
