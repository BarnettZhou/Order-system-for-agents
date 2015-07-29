<?php
return array(
	// 设置应用多模块
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'),
    'MODULE_DENY_LIST'  => array(),
    'DEFAULT_MODULE'    => 'Home',

    // 数据库配置
    'DB_TYPE'   => 'mysql',
    'DB_HOST'   => '127.0.0.1',
    'DB_USER'   => 'admin',
    'DB_PWD'    => 'admin',
    'DB_NAME'   => 'ts_agent',
    'DB_PREFIX' => 'ts_',
);