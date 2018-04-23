<?php

use Phinx\Migration\AbstractMigration;

class CreateBooksTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $users = $this->table('books');
        $users->addColumn('name', 'string', ['limit' => 200])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['null' => true])
            ->save();
    }
    
    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute('DROP database books');
    }
}
