<?php

use Phinx\Migration\AbstractMigration;

class Praise extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('praises',['engine'=>'InnoDB']);

        $table->addColumn('uid', 'integer',['comment'=>'关联id'])
            ->addColumn('bid', 'integer',['comment'=>'关联id'])
            ->addColumn('add_time', 'integer',['comment'=>'时间'])
            ->create();       
    
    }
}
