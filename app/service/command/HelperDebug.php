<?php
/**
 * @copyright since 15:25 14/12/2017
 * @author <mc@dancis.info>
 */
namespace app\service\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class HelperDebug extends Command
{
    protected function configure()
    {
        parent::configure();

        $this->setName('debug-helper')->setDescription('Debug for helper');
    }

    protected function execute(Input $input, Output $output)
    {
        if (is_string($ret = get_a_by_id(mt_rand(0, 8)))) {
            $output->writeln($ret);
        }
    }
}
