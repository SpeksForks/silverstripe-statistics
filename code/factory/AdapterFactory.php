<?php

namespace Ntb\Statistics;

/**
 * Adapter factory for creating statistic adapters.
 *
 * @package Ntb\Statistics
 */
class AdapterFactory {
    /**
     *
     *
     * @return IStatisticAdapter
     * @throws \Exception
     */
    public static function create() {
        $adapter = \Injector::inst()->create('StatisticAdapter');
        $adapter->init();
        return $adapter;
    }

}