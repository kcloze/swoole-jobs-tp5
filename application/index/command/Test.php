<?php

namespace app\index\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class Test extends Command
{
    protected function configure()
    {
        $this->setName('test')->setDescription('Here is the remark ')
        ->addArgument('name', Argument::OPTIONAL, 'Do you like ThinkPHP')
        ->addArgument('last_name', Argument::OPTIONAL, 'Your last name?');
    }

    protected function execute(Input $input, Output $output)
    {
        echo time().PHP_EOL;
        $name = $input->getArgument('name');
        $last_name = $input->getArgument('last_name');
        $output->writeln('TestCommand:'.$name.' '.$last_name);
    }
}
