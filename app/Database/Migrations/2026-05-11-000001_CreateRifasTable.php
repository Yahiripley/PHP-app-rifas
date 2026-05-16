<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;

class CreateRifasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'costo_boleto' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'fecha_sorteo' => [
                'type' => 'DATETIME',
            ],
            'premio' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'imagen_promocional' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('rifas');
    }

    public function down()
    {
        $this->forge->dropTable('rifas');
    }
}

