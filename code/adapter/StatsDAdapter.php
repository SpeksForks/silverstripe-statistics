<?php

namespace Ntb\Statistics;

/**
 * An adapter that can connect to statsd service.
 *
 * @package Ntb\Statistics
 * @author Christian Blank <c.blank@notthatbad.net>
 */
class StatsDAdapter extends AbstractNetworkAdapter {

    /**
     * @param $data
     * @param $time
     * @return mixed|void
     */
    protected function sendToService($data, $time) {
        $fp = $this->socket;

        foreach ($data as $name => $value) {
            // you need to send a newline for each message
            $message = implode(" ", [$name, $value, $time]) . PHP_EOL;
            fwrite($fp, $message);
        }
        fflush($fp);
        fclose($fp);
    }
}
