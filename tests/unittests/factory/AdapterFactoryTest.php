<?php

use Ntb\Statistics\AdapterFactory;

class AdapterFactoryTest extends SapphireTest {

    // test config
    public function testAdapterCreationFromConfig() {
        $configuredAdapter = Config::inst()->get('Injector', 'StatisticAdapter');
        $adapter = AdapterFactory::create();
        $this->assertEquals($configuredAdapter['class'], $adapter->class);
    }

}