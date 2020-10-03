<?php

class Conection
{
    private $conection;

    public function __construct()
    {
        if (!isset($this->conection)) {
            try {
                $this->conection = new PDO(
                    $_ENV['MYSQL_DSN'],
                    $_ENV['MYSQL_USER'],
                    $_ENV['MYSQL_PASSWORD']
                );
            } catch (PDOException $e) {
                echo "Hubo un error: " . $e;
                die();
            }
        }
    }

    public function query_execute($sql, $options = array())
    {
        try {
            $sth = $this->conection->prepare($sql);
            $sth->execute($options);
            $res = $sth->fetch(PDO::FETCH_ASSOC);
            $sth->closeCursor();
            return $res;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
