<?php

use Phinx\Migration\AbstractMigration;

class Comments extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('comments',['engine'=>'InnoDB']);

        $table->addColumn('content', 'string',['limit' => 200,'comment'=>'内容'])
            ->addColumn('uid', 'integer',['comment'=>'关联id'])
            ->addColumn('bid', 'integer',['comment'=>'关联id'])
            ->addColumn('add_time', 'integer',['comment'=>'时间'])
            ->create();       
    }

    
}
