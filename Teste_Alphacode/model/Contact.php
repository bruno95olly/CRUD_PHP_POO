<?php 
    class ContactModel{
        private $id;
        private $nome_completo;
        private $email;
        private $data_nascimento;
        private $profissao;
        private $celular;
        private $telefone;
        private $celular_whatsapp;
        private $envio_sms;
        private $notificacao_email;

        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }

        public function setNome($nome_completo){
            $this->nome_completo = $nome_completo;
        }
        public function getNome(){
            return $this->nome_completo;
        }

        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }

        public function setNascimento($data_nascimento){
            $this->data_nascimento = $data_nascimento;
        }
        public function getNascimento(){
            return $this->data_nascimento;
        }

        public function setProfissao($profissao){
            $this->profissao = $profissao;
        }
        public function getProfissao(){
            return $this->profissao;
        }

        public function setCelular($celular){
            $this->celular = $celular;
        }
        public function getCelular(){
            return $this->celular;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }
        public function getTelefone(){
            return $this->telefone;
        }

        public function setCheckWhatsapp($celular_whatsapp){
            $this->celular_whatsapp = $celular_whatsapp;
        }
        public function getCheckWhatsapp(){
            return $this->celular_whatsapp;
        }

        public function setCheckEmail($notificacao_email){
            $this->notificacao_email = $notificacao_email;
        }
        public function getCheckEmail(){
            return $this->notificacao_email;
        }

        public function setCheckSMS($envio_sms){
            $this->envio_sms = $envio_sms;
        }
        public function getCheckSMS(){
            return $this->envio_sms;
        }
       
    }

?>