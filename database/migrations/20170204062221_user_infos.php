<?php

use Phinx\Migration\AbstractMigration;

class UserInfos extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('userInfos',['engine'=>'InnoDB']);

        $table->addColumn('name', 'string',['limit' => 50,'comment'=>'用户名'])
            ->addColumn('head', 'string',['limit' => 150,'comment'=>'头像'])
            ->addColumn('age', 'string',['limit' => 3,'default'=>'保密','comment'=>'年龄'])
            ->addColumn('sex', 'string',['limit' => 3,'default'=>'保密','comment'=>'性别'])
            ->addColumn('address', 'string',['limit' => 50,'default'=>'保密','comment'=>'地址'])
            ->addColumn('phone', 'string',['limit' => 11,'default'=>'保密','comment'=>'手机'])
            ->addColumn('qq', 'string',['limit' => 11,'default'=>'保密','comment'=>'qq'])
            ->addColumn('state', 'string',['limit' => 20,'default'=>'保密','comment'=>'qq'])
            ->addColumn('profession', 'string',['limit' => 20,'default'=>'保密','comment'=>'qq'])
            ->addColumn('edu', 'string',['limit' => 40,'default'=>'保密','comment'=>'qq'])
            ->addColumn('uid', 'integer',['comment'=>'关联id'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
