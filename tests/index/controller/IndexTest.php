<?php
/**
 * @copyright since 10:41 2/11/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace tests\index\controller;

use tests\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $this->visit('/')
            ->see('<h1>:) Welcome</h1>')
            ->see('<p>S Show API</p>');
    }
}
