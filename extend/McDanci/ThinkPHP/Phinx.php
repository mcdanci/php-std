<?php
/**
 * @copyright since 10:54 5/12/2017
 * @author <mc@dancis.info>
 */
namespace McDanci\ThinkPHP;

class Phinx
{
    const SIGNED = 'signed';

    const
        COMMENT = 'comment',
        TABLE_ENGINE = 'engine',
        TABLE_COLLATION = 'collation';
        //TABLE_SIGNED = self::SIGNED;

    const
        TABLE_ENGINE_INNO = 'InnoDB',
        TABLE_ENGINE_MY_ISAM = 'MyISAM';

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

    const
        COL_OPT_LIMIT = 'limit',
        COL_OPT_LENGTH = 'length',
        COL_OPT_DEFAULT = 'default',
        COL_OPT_NULL = 'null',
        COL_OPT_AFTER = 'after';

    // For `decimal`
    const COL_OPT_PRECISION = 'precision';
    const COL_OPT_SCALE = 'scale';
    const COL_OPT_SIGNED = 'signed'; // For `boolean` in MySQL

    // For `enum` & `set`
    const COL_OPT_VAL = 'values';

    // For `integer` & `bigint`
    const COL_OPT_IDENTITY = 'identity';
    //const COL_OPT_SIGNED = 'signed';

    // For `timestamp`
    //const COL_OPT_DEFAULT = 'default';
    const COL_OPT_UPDATE = 'update';
    const COL_OPT_TIMEZONE = 'timezone';

    const COL_OPT_TIMESTAMP_CURRENT = 'CURRENT_TIMESTAMP';

    // For MySQL
    const COL_OPT_COLLATION = 'collation';
    const COL_OPT_ENCODING = 'encoding';

    // For foreign key, trigger
    //const COL_OPT_UPDATE = 'update';
    const COL_OPT_DELETE = 'delete';

    // Index
    const IDX_OPT_UNIQUE = 'unique';
    const IDX_OPT_NAME = 'name';
    const IDX_NAME_PREFIX = 'idx_';

    const IDX_TEXT_FULL = 'fulltext'; // MyISAM if < MySQL 5.6

    // Other
    const SET_NULL = 'SET_NULL';
    const NO_ACTION = 'NO_ACTION';
    const CASCADE = 'CASCADE';
    const RESTRICT = 'RESTRICT';
    const CONSTRAINT = 'constraint';
}
