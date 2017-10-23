<?php
return [
    'type' => 'mysql',
    'hostname' => '39.108.221.196',
    'database' => 's-show',
    'username' => 'sshow',
    'password' => 'sshowadmin888',

    // 连接dsn
    'dsn' => '',
    // 数据库连接参数
    'params' => [],

    'charset' => 'utf8mb4',
    'prefix' => 'ss_reg_',
    'debug' => true,
    'deploy' => 0,
    'rw_separate' => false,

    // 读写分离后 主服务器数量
    'master_num' => 1,
    // 指定从服务器序号
    'slave_no' => '',
    // 是否严格检查字段是否存在
    'fields_strict' => true,
    // 数据集返回类型
    'resultset_type' => 'array',
    // 自动写入时间戳字段
    'auto_timestamp' => false,
    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',
    // 是否需要进行SQL性能分析
    'sql_explain' => false,
];
