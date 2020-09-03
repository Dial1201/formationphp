<?php

require_once('Database.php');

abstract class Model {

    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findAll(?string $order = ""):array {
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
           $sql.= " ORDER BY ".$order;
        }

        $resultats = $this->db->query($sql);
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function find(int $id) {
        
        $query = $this->db-> prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();

        return $item;
    }

    public function delete(int $id): void {
        
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}