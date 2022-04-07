<?php

namespace Application\Core;

use Application\lib\Db;

abstract class Model
{

    public $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}
