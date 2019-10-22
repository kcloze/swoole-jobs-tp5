<?php

namespace app\service;

use Kcloze\Jobs\JobObject;
use Kcloze\Jobs\Logs;
use Kcloze\Jobs\Queue\BaseTopicQueue;
use Kcloze\Jobs\Queue\Queue;

/**
 * 异步任务操作类
 * 开发步骤：
 * 1、在application\jobs目录中编写任务处理类，可以一个类中编写多个处理方法，每个方法设置不同参数
 * 2、在application\extra\swoole-jobs.php文件中编辑job->topics处理进程任务数
 * 3、在其他地方调用\app\service\SwooleJob::push()方法，并设置对应参数即可.
 */
class SwooleJobs
{
    private static $queue=null;
    /**
     * 私有构造函数，防止外界实例化对象
     */
    public function __construct()
    {
        $config   = require_once APP_PATH . 'swoole-jobs.php';
        $logger = Logs::getLogger($config['logPath'] ?? '', $config['logSaveFileApp'] ?? '');
        if(static::$queue==null){
            static::$queue  = Queue::getQueue($config['job']['queue'], $logger);
            //设置工作进程参数
            static::$queue->setTopics($config['job']['topics']);
        }

    }

    /**
     * 私有克隆函数，防止外办克隆对象
     */
    private function __clone()
    {
    }

    /**
     * 推送swoole异步任务
     *
     * @param string $jobName  topic名，跟swoole-jobs配置一致
     * @param string $jobClass 任务名称,对应application/index/command目录中的类名
     * @param string $method   类方法名
     * @param array  $params   方法参数，类型为数组，数组值顺序对应方法参数顺序
     * @param array  $jobExt   任务附加参数['delay'=>'延迟毫秒数','priority'=>'任务权重,数字类型,范围：1-5']
     * @param mixed  $topic
     * @param mixed  $jobClass
     *
     * @throws \Exception
     */
    public function push($jobName, $jobClass, $method = '', $params = [], $jobExt = [])
    {
        if (empty($jobName)) {
            throw new \Exception('异步任务名不能为空');
        }

        $jobExtras['delay']    = isset($jobExt['delay']) ? $jobExt['delay'] : 0;
        $jobExtras['priority'] = isset($jobExt['priority']) ? $jobExt['priority'] : BaseTopicQueue::HIGH_LEVEL_1;

        $job      = new JobObject($jobName, $jobClass, $method, $params, $jobExtras);
        $result   = static::$queue->push($jobName, $job);

        return $result;
    }
}
