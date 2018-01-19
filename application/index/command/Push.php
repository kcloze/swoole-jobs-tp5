<?php

namespace app\index\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Push extends Command
{
    protected function configure()
    {
        $this->setName('push')->setDescription('Push swoole jobs ');
    }

    protected function execute(Input $input, Output $output)
    {

        $name = \app\service\SwooleJobs::push('MyJob', 'test');

        $output->writeln('Push swoole jobs :');
    }
}
