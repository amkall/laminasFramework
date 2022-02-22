<?php

namespace MyObject\Factorie;

class MyObject{

    public function __invoke(ContainerInterface $container, $requestdName, array $options = null){
        $tableGateway = $container->get(Dependecy::class);
        return new Model\AlbumTable($tableGateway);
    }
}