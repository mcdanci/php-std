<?php
/**
 * @copyright since 10:54 5/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace McDanci\ThinkPHP;

class Phinx
{
    const
        TABLE_COMMENT = 'comment',
        TABLE_ENGINE = 'engine',
        TABLE_COLLATION = 'collation',
        TABLE_SIGNED = 'signed';

    const TABLE_ENGINE_INNO = 'InnoDB';

    const
        TABLE_COLLATION_U8G = 'utf8_general_ci',
        TABLE_COLLATION_U8MG = 'utf8mb4_general_ci';

    const
        // MySQL adapter
        COL_TYP_ENUM = 'enum',
        COL_TYP_SET = 'set',
        COL_TYP_BLOB = 'blob',
        COL_TYP_JSON = 'json', // MySQL >= 5.7

        // Postgres (>= 9.3) adapter
        COL_TYP_INT_SMALL = 'smallint',
        //COL_TYP_JSON = 'json',
        COL_TYP_JSONB = 'jsonb',
        COL_TYP_CIDR = 'cidr',
        COL_TYP_INET = 'inet',
        COL_TYP_MAC = 'macaddr',

        // Common
        COL_TYP_INT_BIG = 'biginteger',
        COL_TYP_BIN = 'binary',
        COL_TYP_BOOL = 'boolean',
        COL_TYP_DATE = 'date',
        COL_TYP_DATETIME = 'datetime',
        COL_TYP_DECIMAL = 'decimal',
        COL_TYP_FLOAT = 'float',
        COL_TYP_INT = 'integer',
        COL_TYP_STRING = 'string',
        COL_TYP_TEXT = 'text',
        COL_TYP_TIME = 'time',
        COL_TYP_TIMESTAMP = 'timestamp',
        COL_TYP_UUID = 'uuid';
}
