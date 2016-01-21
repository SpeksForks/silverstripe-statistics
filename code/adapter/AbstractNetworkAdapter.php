<?php

namespace Ntb\Statistics;

/**
 * Class AbstractNetworkAdapter
 * @package Ntb\Statistics
 * @author Christian Blank <c.blank@notthatbad.net>
 */
abstract class AbstractNetworkAdapter extends \Object implements IStatisticAdapter {
    /**
     *
     * @var string
     */
    public $host;

    /**
     * @var int
     */
    public $port;

    /**
     * @var resource
     */
    protected $socket;

    static $dependencies = [
        'host'        => 'localhost',
        'port'        => '2003'
    ];

    public function init() {
        $this->socket = $this->createSocket();
    }

    /**
     *
     *
     * @param IIndicator[] $indicators
     * @return array
     */
    protected function processIndicators($indicators) {
        $namespace = \Config::inst()->get('StatisticTask', 'Namespace');
        $separator = \Config::inst()->get('StatisticTask', 'Separator');
        if(!empty($namespace)) {
            $namespace .= $separator;
        } else {
            $namespace = '';
        }
        $data = [];
        foreach($indicators as $indicator) {
            $data[$namespace . $indicator->name()] = $indicator->fetch();
        }

        return $data;
    }

    /**
     *
     *
     * @return int
     */
    protected function currentTime() {
        return time();
    }

    /**
     *
     * @return resource
     */
    protected function createSocket() {
        $fp = @fsockopen("tcp://{$this->host}", $this->port, $errorNo, $errorMsg, 1);
        return $fp;
    }

    /**
     * @return bool
     */
    public function canConnect() {
        return is_resource($this->socket);
    }

    /**
     * @param $indicators
     */
    public function send($indicators) {
        $data = $this->processIndicators($indicators);
        $time = $this->currentTime();
        // send data over the wire to specified address
        $this->sendToService($data, $time);
    }

    /**
     * @param $data
     * @param $time
     * @return mixed
     */
    protected abstract function sendToService($data, $time);

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }
}