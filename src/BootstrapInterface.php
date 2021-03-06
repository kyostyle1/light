<?php

namespace Cottect\Light;

use Phalcon\Config;
use Phalcon\DiInterface;

interface BootstrapInterface {

    public function run(Api $api, DiInterface $di, Config $config);

}