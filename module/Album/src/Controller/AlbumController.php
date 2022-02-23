<?php

namespace Album\Controller;

use Album\Model\AlbumTable;
use Album\Model\CantorTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{
        // Add this property:
    private $table;
    private $cantor;

    // Add this constructor:
    public function __construct(AlbumTable $table, CantorTable $cantor)
    {
        $this->table  = $table;
        $this->cantor = $cantor;
    }

    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->table->fetchAll(),
            'cantor' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}