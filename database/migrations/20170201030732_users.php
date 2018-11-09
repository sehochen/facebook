<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    public function change()
    {
        // http://docs.phinx.org/en/latest/migrations.html
        // create the table
        $table = $this->table('users',['id'=>'uid','engine'=>'InnoDB']);

        $table->addColumn('email', 'string',['limit' => 60,'comment'=>'用户名'])
            ->addColumn('password', 'string',['limit' => 32,'comment'=>'密码'])
            ->addColumn('last_time', 'integer',['default'=>time(),'comment'=>'登录时间'])
            // ->addIndex(['username'], ['unique' => true])
            ->create();
    }


}
