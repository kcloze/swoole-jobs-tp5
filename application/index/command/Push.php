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
        for ($i=0; $i < 100; $i++) {
            $service = new \app\service\SwooleJobs();
            $name=$service->push('MyJob', 'test', '', ['ketty',time()]);
            $output->writeln('Push swoole jobs : '.$name);
        }
    }
}
