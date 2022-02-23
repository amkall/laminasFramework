<?php

namespace Album\Model;

class Cantor
{
    public $id;
    public $nome;
    public $matricula;

    public function exchangeArray(array $data)
    {
        $this->id         = !empty($data['id']) ? $data['id'] : null;
        $this->nome       = !empty($data['nome']) ? $data['nome'] : null;
        $this->matricula  = !empty($data['matricula']) ? $data['matricula'] : null;
    }
} 