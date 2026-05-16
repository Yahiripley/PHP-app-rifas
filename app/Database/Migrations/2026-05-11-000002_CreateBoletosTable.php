<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;

class CreateBoletosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'rifa_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'numero_boleto' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'cliente_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['disponible', 'apartado', 'pagado'],
                'default' => 'disponible',
            ],
            'fecha_compra' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'resultado' => [
                 'type' => 'ENUM',
                'constraint' => ['primero', 'segundo', 'tercero', 'ninguno'],
                'default' => 'ninguno',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['rifa_id', 'numero_boleto']);
        $this->forge->addForeignKey('rifa_id', 'rifas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('cliente_id', 'usuarios', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('boletos');
    }

    public function down()
    {
        $this->forge->dropTable('boletos');
    }
}
