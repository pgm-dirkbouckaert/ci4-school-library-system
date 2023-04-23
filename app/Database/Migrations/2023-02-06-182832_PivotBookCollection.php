<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PivotBookCollection extends Migration {

  public function up() {

    $this->forge->addField([
      'book_id'  => [
        'type'           => 'INT',
        'unsigned'       => true,
      ],
      'collection_id' => [
        'type'           => 'INT',
        'unsigned'       => true,
      ],
    ]);
    // $this->forge->addKey('id', true); //addKey($key[, $primary = false[, $unique = false]])
    $this->forge->createTable('pivot_book_collection');
  }

  public function down() {
    $this->forge->dropTable('pivot_book_collection');
  }
}
