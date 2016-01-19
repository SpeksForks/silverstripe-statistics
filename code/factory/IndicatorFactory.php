<?php

namespace Ntb\Statistics;

/**
 * Factory for the different statistic indicators.
 * @package Ntb\Statistics
 */
class IndicatorFactory {
    /**
     * The indicator interface name
     * @var string
     */
    private static $interface_name = 'Ntb\Statistics\IIndicator';

    /**
     * Returns an array of all implementors of the `IIndicator` interface.
     *
     * @return IIndicator[] list of all implementors
     */
    public static function get_all() {
        $indicators = \ClassInfo::implementorsOf(self::$interface_name);

        return array_map(function($indicatorName) {
            return \Object::create($indicatorName);
        }, $indicators);
    }
}