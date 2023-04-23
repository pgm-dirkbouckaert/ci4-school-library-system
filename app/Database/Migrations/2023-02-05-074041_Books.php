<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Books extends Migration {

  public function up() {

    $this->forge->addField([
      'book_id'          => [
        'type'           => 'INT',
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'title'       => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'authors'       => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'isbn' => [
        'type' => 'VARCHAR',
        'constraint' => '13',
      ],
      'language_code' => [
        'type' => 'VARCHAR',
        'constraint' => '10',
      ],
      'difficulty_level' => [
        'type' => 'VARCHAR',
        'constraint' => '255',
      ],
      'publication_year' => [
        'type' => 'VARCHAR',
        'constraint' => '4',
      ],
      'publisher' => [
        'type' => 'VARCHAR',
        'constraint' => '255',
      ],
      'available' => [
        'type' => 'TINYINT',
        'constraint' => '1',
        'default' => 1,
      ],
      'img' => [
        'type' => 'VARCHAR',
        'constraint' => '255',
      ],
      'created_at' => [
        'type' => 'TIMESTAMP',
      ],
    ]);
    $this->forge->addKey('book_id', true); //addKey($key[, $primary = false[, $unique = false]])
    $this->forge->createTable('books');
  }

  public function down() {
    $this->forge->dropTable('books');
  }
}
