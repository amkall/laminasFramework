<?php
namespace Album;

// Add these import statements:
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use MyObject\Factorie;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
     // Add this method:
     public function getServiceConfig()
     {
         return [
             'factories' => [
                 Model\AlbumTable::class => function($container) {
                     $tableGateway = $container->get(Model\AlbumTableGateway::class);
                     return new Model\AlbumTable($tableGateway);
                 },
                 Model\AlbumTableGateway::class => function ($container) {
                     $dbAdapter = $container->get(AdapterInterface::class);
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                     return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                 },
                 Model\CantorTable::class => function($container) {
                    $tableGateway = $container->get(Model\CantorTableGateway::class);
                    return new Model\CantorTable($tableGateway);
                },
                Model\CantorTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Cantor());
                    return new TableGateway('cantor', $dbAdapter, null, $resultSetPrototype);
                },
             ],
         ];
     }
     // Add this method:
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumController::class => function($container) {
                    return new Controller\AlbumController(
                        $container->get(Model\AlbumTable::class), $container->get(Model\CantorTable::class)
                    );
                },
            ],
        ];
    }
}