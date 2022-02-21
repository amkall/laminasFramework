<?php

use namespace Album;

class MyObject{

    public function __invoke(ContainerInterface $container, $requestdName, array $options = null){
        $tableGateway = $container->get($requestdName::class);
        return new $requestdName($dependency);
    }
}