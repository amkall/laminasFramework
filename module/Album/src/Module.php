<?php
namespace Album;

// Add these import statements:
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Model\Album;
use Model\AlbumTable;
use Model\AlbumTableGateway;
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
                 AlbumTable::class => function($container) {
                     $tableGateway = $container->get(AlbumTableGateway::class);
                     return new AlbumTable($tableGateway);
                 },
                 AlbumTableGateway::class => function ($container) {
                     $dbAdapter = $container->get(AdapterInterface::class);
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Album());
                     return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
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
                        $container->get(AlbumTable::class)
                    );
                },
            ],
        ];
    }
}