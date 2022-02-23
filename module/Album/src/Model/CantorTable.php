<?php

namespace Album\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class CantorTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getCantor($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveCantor(Cantor $cantor)
    {
        $data = [
            'artist' => $cantor->artist,
            'title'  => $cantor->title,
        ];

        $id = (int) $cantor->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getCantor($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update cantor with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteCantor($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}