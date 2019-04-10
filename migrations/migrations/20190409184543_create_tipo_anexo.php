<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Table\Column;

class CreateTipoAnexo extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $col = new Column();
        $col->setName('id_tipo_anexo')
            ->setType('integer')
            ->setIdentity(true)
            ->setSigned(false);
        $table = $this->table('tb_elic_sc_lic_tipo_anexo', ['id' => false, 'primary_key' => 'id_tipo_anexo']);
        $table->addColumn($col);
        $table->addColumn('nm_tipo_anexo', 'string', ['null'=> false]);
        $table->addTimestamps()
            ->create();

        $table->save();
    }
}