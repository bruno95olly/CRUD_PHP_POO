<?php 

    if(isset($_GET['modo'])){
        require_once('./config.php');
        require_once('./controller/ContactController.php');

        $modo = $_GET['modo'];

        switch(strtoupper($modo)){
            case 'INSERIR':
                $contatoController = new ContactController();
                $contatoController->newContact();
                break;

            case 'DELETAR':
                $contatoController = new ContactController();
                $contatoController->removeContact($_POST['id']);
                break;

            case 'BUSCAR':
                $contatoController = new ContactController();
                $dataContact = $contatoController->findContact($_POST['id']);
                break;
            
            case 'ATUALIZAR':
                $contatoController = new ContactController();
                $dataContact = $contatoController->ActualizeContact($_GET['id']);
                break;
        }

    }

?>