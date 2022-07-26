<?php 
    class Connect{
        private $server;
        private $user;
        private $pwd;
        private $database;

        public function __construct()
        {
            $this->server = "localhost";
            $this->database = "dbcontatos";
            $this->user = "root";
            $this->pwd = "bcd127";
        }

        public function connectDatabase(){
            try{
                $connection = new PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->user, $this->pwd);
                return $connection;
            }
            catch(PDOException $e){
                echo("Erro de conexão com o banco de dados!<br>
                      Mensagem de erro: ".$e->getMessage()."
                      <br>Linha do erro:".$e->getLine());
            }
        }
    }
?>