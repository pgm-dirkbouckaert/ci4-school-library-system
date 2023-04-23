<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LanguageCodes extends Migration {

  public function up() {

    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true,
      ],
      'language' => [
        'type' => 'VARCHAR',
        'constraint' => '255',
      ],
      'code_639_1' => [
        'type' => 'VARCHAR',
        'constraint' => '5',
      ],
      'code_639_3' => [
        'type' => 'VARCHAR',
        'constraint' => '5',
      ],
      'created_at' => [
        'type' => 'TIMESTAMP',
      ]
    ]);
    $this->forge->addKey('id', true); //addKey($key[, $primary = false[, $unique = false]])
    $this->forge->createTable('language_codes');
  }

  public function down() {
    $this->forge->dropTable('language_codes');
  }
}
