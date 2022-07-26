<?php
    require_once(DIRECTORY.'model/Contact.php');
    require_once(DIRECTORY.'dao/ContactDAO.php');

    class ContactController{
       private $contato;

       public function newContact(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $this->contato = new ContactModel();
            $this->contato->setNome($_POST['nome']);
            $this->contato->setNascimento($_POST['nascimento']);
            $this->contato->setEmail($_POST['email']);
            $this->contato->setCelular($_POST['celular']);
            $this->contato->setTelefone($_POST['telefone']);
            $this->contato->setProfissao($_POST['profissao']);
            $this->contato->setCheckEmail($_POST['chkEmail']);
            $this->contato->setCheckSMS($_POST['chkSMS']);
            $this->contato->setCheckWhatsapp($_POST['chkWhatsapp']);
        }
        $contatoDAO = new ContactDAO();

        if($contatoDAO->insertContact($this->contato)){
            echo "Message: status 200";
        }
        else{
            echo "Message: status 400";
        }
       }

       public function listContact(){
        $contatoDAO = new ContactDAO();
        return $contatoDAO->selectContacts();
       }

       public function findContact($id){
        $contatoDAO = new ContactDAO();
        $dataContact = $contatoDAO->selectByIdContact($id);
        
        $arrayDataContact = array(
            "nome"=>$dataContact->getNome(),
            "nascimento"=>$dataContact->getNascimento(),
            "celular"=>$dataContact->getCelular(),
            "telefone"=>$dataContact->getTelefone(),
            "profissao"=>$dataContact->getProfissao(),
            "email"=>$dataContact->getEmail(),
            "chkEmail"=>$dataContact->getCheckEmail(),
            "chkWhatsapp"=>$dataContact->getCheckWhatsapp(),
            "chkSMS"=>$dataContact->getCheckSMS(),
            "id"=>$dataContact->getId()
        );
            $json = json_encode($arrayDataContact);
            echo $json;
        }

        public function ActualizeContact($id){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $this->contato = new ContactModel();
                $this->contato->setId($id);
                $this->contato->setNome($_POST['nome']);
                $this->contato->setNascimento($_POST['nascimento']);
                $this->contato->setEmail($_POST['email']);
                $this->contato->setCelular($_POST['celular']);
                $this->contato->setTelefone($_POST['telefone']);
                $this->contato->setProfissao($_POST['profissao']);
                $this->contato->setCheckEmail($_POST['chkEmail']);
                $this->contato->setCheckSMS($_POST['chkSMS']);
                $this->contato->setCheckWhatsapp($_POST['chkWhatsapp']);
            }
            $contatoDAO = new ContactDAO();
    
            if($contatoDAO->updateContact($this->contato)){
                echo "Message: status 200";
            }
            else{
                echo "Message: status 400";
            }
           }

       public function removeContact($id){
        $contatoDAO = new ContactDAO();
        if($contatoDAO->deleteContact($id)){
            echo "Message: status 200";
        }
        else{
            echo "Message: status 400";
        }
       }
    }

?>