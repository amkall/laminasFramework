<?php
 
namespace Album;

class MyObjectTable{

    public function __invoke(ContainerInterface $container, $requestDName){
        $dbAdapter         = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResulSet();
        
        $resultSetPrototype->setArrayObjectPrototype(new $requestDName());
        return new TableGateway($requestDName, $dbAdapter, null, $resultSetPrototype);
    }
}