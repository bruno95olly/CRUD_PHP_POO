<?php 

    class ContactDAO{

        private $database;
        private $connection;

        public function __construct()
        {
            require_once('Connect.php');

            $this->database = new Connect();
            $this->connection = $this->database->connectDatabase();
        }

        public function insertContact($contact){

            $sql = "insert into tbl_contatos
                    (nome_completo, data_nascimento,
                    profissao, email, celular, telefone,
                    celular_whatsapp, notificacao_email,
                    envio_sms)
                    
                    values(:nome_completo, :data_nascimento, 
                    :profissao, :email, :celular, :telefone, 
                    :celular_whatsapp, :notificacao_email, 
                    :envio_sms)
                    ";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':nome_completo', $nome_completo);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':profissao', $profissao);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':celular_whatsapp', $celular_whatsapp);
            $stmt->bindParam(':notificacao_email', $notificacao_email);
            $stmt->bindParam(':envio_sms', $envio_sms);

            $nome_completo = strtolower($contact->getNome());
            $data_nascimento = strtolower($contact->getNascimento());
            $profissao = strtolower($contact->getProfissao());
            $email = strtolower($contact->getEmail());
            $celular = strtolower($contact->getCelular());
            $telefone = strtolower($contact->getTelefone());
            $celular_whatsapp = strtolower($contact->getCheckWhatsapp());
            $notificacao_email = strtolower($contact->getCheckEmail());
            $envio_sms = strtolower($contact->getCheckSMS());

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        public function selectContacts(){
            $sql = "select * from tbl_contatos";
            $result = $this->connection->query($sql);
            $i = 0;

            while($rsContato = $result->fetch(PDO::FETCH_ASSOC)){
                $contatos[] = new ContactModel();

                $contatos[$i]->setId($rsContato['id']);
                $contatos[$i]->setNome($rsContato['nome_completo']);
                $contatos[$i]->setEmail($rsContato['email']);
                $contatos[$i]->setCelular($rsContato['celular']);
                $contatos[$i]->setNascimento($rsContato['data_nascimento']);

                $i++;
            }
             return $contatos;
        }
        public function selectByIdContact($id){
            $sql = "select * from tbl_contatos where id=".$id;
            $result = $this->connection->query($sql);
		
            if($rsContato = $result->fetch(PDO::FETCH_ASSOC)){
                $contato = new ContactModel();
                
                $contato->setId($rsContato['id']);
                $contato->setNome($rsContato['nome_completo']);
                $contato->setEmail($rsContato['email']);
                $contato->setCelular($rsContato['celular']);
                $contato->setTelefone($rsContato['telefone']);
                $contato->setNascimento($rsContato['data_nascimento']);
                $contato->setProfissao($rsContato['profissao']);
                $contato->setCheckSMS($rsContato['envio_sms']);
                $contato->setCheckEmail($rsContato['notificacao_email']);
                $contato->setCheckWhatsapp($rsContato['celular_whatsapp']);
            }
            return $contato;
        }
        public function updateContact($contact){
            $sql = "update tbl_contatos set nome_completo = :nome_completo, telefone = :telefone,
                celular=:celular, email=:email, profissao=:profissao, 
                data_nascimento=:data_nascimento, envio_sms=:envio_sms, celular_whatsapp=:celular_whatsapp, 
                notificacao_email=:notificacao_email where id=:id";
            
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':nome_completo', $nome_completo);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':profissao', $profissao);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':celular_whatsapp', $celular_whatsapp);
            $stmt->bindParam(':notificacao_email', $notificacao_email);
            $stmt->bindParam(':envio_sms', $envio_sms);
            $stmt->bindParam(':id', $id);

            $id = strtolower($contact->getId());
            $nome_completo = strtolower($contact->getNome());
            $data_nascimento = strtolower($contact->getNascimento());
            $profissao = strtolower($contact->getProfissao());
            $email = strtolower($contact->getEmail());
            $celular = strtolower($contact->getCelular());
            $telefone = strtolower($contact->getTelefone());
            $celular_whatsapp = strtolower($contact->getCheckWhatsapp());
            $notificacao_email = strtolower($contact->getCheckEmail());
            $envio_sms = strtolower($contact->getCheckSMS());


            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

        }
        public function deleteContact($id){
            $sql = "delete from tbl_contatos where id=".$id;

            if($this->connection->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
    }

?>