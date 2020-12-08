<?php

namespace App\Entities;

use App\Utilities\Database\Db;

class Model
{
    /**
     * @var null
     */
    protected $db;

    /**
     * @var
     */
    protected $table;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance()->getConnection();
    }

    /**
     *
     */
    public function all()
    {
        return $this->db->query("SELECT * FROM {$this->table}")->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->db->query("SELECT * FROM {$this->table} WHERE id={$id}")->fetch();
    }
}