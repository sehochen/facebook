ThinkPHP 5.0  for facebook
===============

采用ThinkPHP5+bootstrap+layer

## vendor和public目录因为权限问题,无法上传，解压static解压到public目录，vendor可以从官方tp5.05提取出来


微云下载链接
+ https://share.weiyun.com/982221916b9082b46d3f6e7b4729369a

https://share.weiyun.com/266d3730f0c522c29b6e54db8bcbb136



 + 发布微博
 + 发布评论
 + 个人资料
 + 密码修改
 + 资料修改
 + 用户推荐
 + 用户搜索
 + 点赞
 + 转发
 +...
 
 
> ThinkPHP5的运行环境要求PHP5.4以上。

详细开发文档参考 [ThinkPHP5完全开发手册](http://www.kancloud.cn/manual/thinkphp5)




> 切换到public目录后，启动命令：php -S localhost:8888  router.php

## 使用

  1.修改 /application/config.php，必须配置，不然css、js、images无法加载
  
 
     // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__STATIC__' =>   '/tp5/public/static',         // 静态资源存放目录
        '__PUBLIC__' =>   '/tp5/public',         // 静态资源存放目录
    ],
    
  
  
    例子：      
      
    
    'view_replace_str'       => [
    
        '__STATIC__' =>   '/tp5-facebook/public/static',         // 静态资源存放目录
        '__PUBLIC__' =>   '/tp5-facebook/public',         // 静态资源存放目录
        
    ],
        
    
    
    
    
  tp5是项目的目录名称，必须更改
 
 
 
  2.数据库配置
  
  
        return [
           // 数据库类型
           'type'            => 'mysql',
           // 服务器地址
           'hostname'        => '127.0.0.1',
           // 数据库名
           'database'        => 'tp5',
           // 用户名
           'username'        => 'root',
           // 密码
           'password'        => '',
           // 端口
           'hostport'        => '3306',
           // 连接dsn
           'dsn'             => '',
           // 数据库连接参数
           'params'          => [],
           // 数据库编码默认采用utf8
           'charset'         => 'utf8',
           // 数据库表前缀
           'prefix'          => 'fb_',
           // 数据库调试模式
           'debug'           => true,
           // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
           'deploy'          => 0,
           // 数据库读写是否分离 主从式有效
           'rw_separate'     => false,
           // 读写分离后 主服务器数量
           'master_num'      => 1,
           // 指定从服务器序号
           'slave_no'        => '',
           // 是否严格检查字段是否存在
           'fields_strict'   => true,
           // 数据集返回类型
           'resultset_type'  => 'array',
           // 自动写入时间戳字段
           'auto_timestamp'  => false,
           // 时间字段取出后的默认时间格式
           'datetime_format' => 'Y-m-d H:i:s',
           // 是否需要进行SQL性能分析
           'sql_explain'     => false,
           // Builder类
           'builder'         => '',
           // Query类
           'query'           => '\\think\\db\\Query',
       ];



  3.数据库创建

   命令行切换到tp所在目录

   php think migrate:run

   注：详细命令 php think
   
   
   访问
   
   + http://localhost/项目目录名/public/index.php/login/index.html
   
   +这里的项目目录就是上面配置css、js的路径，默认为 /tp5-facebook
   
## 版权信息

本项目由布尔开发。

## 演示

<img class="BDE_Image" pic_type="0" width="315" height="555" src="http://imgsrc.baidu.com/forum/w%3D580/sign=26b2cd3b8b26cffc692abfba89034a7d/7c91d43f8794a4c2ece95c8907f41bd5ac6e3967.jpg" size="30577" style="cursor: url(&quot;http://tb2.bdstatic.com/tb/static-pb/img/cur_zin.cur&quot;), pointer;">

<img  width="560" height="277" src="http://imgsrc.baidu.com/forum/w%3D580/sign=b32e546bde2a60595210e1121835342d/e6116e061d950a7be029f66603d162d9f2d3c90a.jpg">


<img width="560" height="277" src="http://imgsrc.baidu.com/forum/w%3D580/sign=e600ded1f2f2b211e42e8546fa816511/8c8e59ee3d6d55fb44c3ce8464224f4a20a4dd21.jpg">


<img width="560" height="277" src="http://imgsrc.baidu.com/forum/w%3D580/sign=427315b07b0e0cf3a0f74ef33a47f23d/70ad4aed2e738bd4613d0a93a88b87d6277ff90a.jpg">


<img width="560" height="267" src="http://imgsrc.baidu.com/forum/w%3D580/sign=98d5f3ac6e09c93d07f20effaf3cf8bb/0df6ce1b9d16fdfafe937f4cbd8f8c5495ee7baa.jpg" >

