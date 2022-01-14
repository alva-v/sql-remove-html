<?php

class Database
{

    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('sqlite:' . $_ENV['SRH_DATABASE']);
            echo 'Connection to DB \'' .  
                $_ENV['SRH_DATABASE'] . 
                '\' established' . 
                PHP_EOL;
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function createColumn(string $table, string $newColumn): void
    {
        $stmt = "ALTER TABLE $table ADD $newColumn TEXT";
        $request = $this->db->prepare($stmt);
        $request->execute();
        echo 'Column "' . $newColumn . '" created' . PHP_EOL;
    }

    public function htmlLessCopy(
        string $originalCol,
        string $newCol,
        string $table
    ): void {
        $stmt = "SELECT id, $originalCol FROM $table";
        $request = $this->db->prepare($stmt);
        $request->execute();
        $articles = $request->fetchall();
        $stmt = "UPDATE $table SET $newCol = ? WHERE id = ?";
        $request = $this->db->prepare($stmt);
        foreach ($articles as $article) {
            $plaindesc = str_replace('<', ' <', $article['description']);
            $plaindesc = strip_tags($plaindesc);
            $plaindesc = preg_replace('/\s\s+/', ' ', $plaindesc);
            $plaindesc = preg_replace('/^\s|\s$/', '', $plaindesc);
            $request->execute([
                $plaindesc,
                $article['id']
            ]);
            echo 'Row ' .
                $article['id'] .
                ' copied with HTML removed' .
                PHP_EOL;
        }
    }
}
