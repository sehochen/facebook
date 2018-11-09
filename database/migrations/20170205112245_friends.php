<?php

use Phinx\Migration\AbstractMigration;

class Friends extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('friends',['engine'=>'InnoDB']);

        $table->addColumn('uid', 'integer',['comment'=>'uid'])
            ->addColumn('fid', 'integer',['comment'=>'关注者id'])
            ->addColumn('add_time', 'integer',['comment'=>'添加时间'])
            ->create();
    }
}
