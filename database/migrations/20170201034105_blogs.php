<?php

use Phinx\Migration\AbstractMigration;

class Blogs extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('blogs',['engine'=>'InnoDB']);

        $table->addColumn('uid', 'integer',['comment'=>'密码'])
            ->addColumn('content', 'text',['limit' => 15,'comment'=>'用户名'])
            ->addColumn('add_time', 'integer',['comment'=>'登录时间'])
            ->addColumn('share', 'integer',['default'=>'0','comment'=>'分享者的id'])
            // ->addIndex(['uid'], ['unique' => true])
            ->create();
    }
}
