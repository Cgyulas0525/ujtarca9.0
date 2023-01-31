<?php

class invoice
{
    public $id;
    public $filename;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    function __construct()
    {
        $this->pdo = new mySQLDatabase();
        $this->date = date('Y-m-d H:i:s', strtotime('now'));
    }

    public function getAll() {
        $sql = "SELECT * FROM invoices WHERE deleted_at IS NULL";
        $smtp = $this->pdo->executeStatement($sql);
        if ($smtp) {
            $record = $smtp->fetchAll();
            return (count($record) > 0) ? $record : null;
        } else {
            return null;
        }
    }

    public function getRecord($id) {
        $sql = "SELECT * FROM invoices WHERE deleted_at IS NULL AND id = " .$id;
        $smtp = $this->pdo->executeStatement($sql);
        if ($smtp) {
            $record = $smtp->fetchAll();
            return (count($record) == 1) ? $record : null;
        } else {
            return null;
        }
    }
}
