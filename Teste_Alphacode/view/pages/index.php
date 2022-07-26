<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alphacode - Cadastro</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/input.css">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" preload href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,200,1,0" />
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/request.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/mask.js"></script>  
</head>
<body>
    <header>
        <img src="../media/logo_alphacode.png" alt="">
        <h1>Cadastro de contatos</h1>
    </header>
    <main>
        <form id="formContato" method="post">
            <div class="input-outlined">
                <input placeholder=" " id="nome_completo" onkeyup="textMask(this)" maxlength="50" type="text" required title="Digite seu nome completo">
                <div class="underline"></div>
                <label>Nome completo *</label>
            </div>
            <div class="input-outlined">
                <input onkeyup="validatorData(this)" placeholder=" " id="nascimento" maxlength="10" type="text" required title="Data de nascimento: 00/00/0000">
                <div class="underline"></div>
                <label>Data de nascimento *</label>
                <small id="textData"></small>
            </div>
            <div class="input-outlined">
                <input placeholder=" " autocomplete="off" onkeyup="validatorEmail(this)" id="email" type="email" maxlength="60" required title="seuemail@dominio.com">
                <div class="underline"></div>
                <label>E-mail *</label>
                <small id="textEmail"></small>
            </div>
            <div class="input-outlined">
                <input class="no-required" placeholder=" " id="profissao" maxlength="50" onkeyup="textMask(this)" type="text"  title="Digite sua profissão, caso tenha">
                <div class="underline"></div>
                <label>Profissão</label>
            </div>
            <div class="input-outlined">
                <input onkeyup="validatorTelephone(this)" class="no-required" placeholder=" " id="telefone" maxlength="10" type="text" title="(00) 0000-0000">
                <div class="underline"></div>
                <label>Telefone para contato</label>
                <small id="textTelephone"></small>
            </div>
            <div class="input-outlined">
                <input onkeyup="validatorCelular(this)" placeholder=" " id="celular" maxlength="11" type="text" required title="(00) 00000-0000">
                <div class="underline"></div>
                <label>Celular para contato *</label>
                <small id="textCelular"></small>
            </div>
            <!-- Checkbox Bootstrap -->
            <div class="form-check">
                <input value="0" id="chkWhatsapp" class="form-check-input" type="checkbox">
                <label class="form-check-label" for="chkWhatsapp">
                  Número de celular possui Whatsapp
                </label>
              </div>
              <div class="form-check">
                <input value="0" id="chkEmail" class="form-check-input" type="checkbox">
                <label class="form-check-label" for="chkEmail">
                  Enviar notificações por E-mail
                </label>
              </div>
              <div class="form-check">
                <input value="0" id="chkSMS" class="form-check-input" type="checkbox">
                <label class="form-check-label" for="chkSMS">
                  Enviar notificações por SMS
                </label>
              </div>
              <button id="buttonSubmit" data-acao="salvar" data-id="0">SALVAR CONTATO</button>
              <small id="textErro"></small>

        </form>
        <div class="container-message">
            <div class="message"></div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nascimento</th>
                        <th>Email</th>
                        <th>Celular para contato</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('../../config.php');
                        require_once(DIRECTORY.'controller/ContactController.php');

                        $dataContacts = new ContactController();
                        $contacts = $dataContacts->listContact();
                        $i = 0;
                        while($i < count($contacts)){
                        
                            $original_date = $contacts[$i]->getNascimento();
                            $timestamp = strtotime($original_date);
                            
                            // Creating new date format from that timestamp
                            $new_date = date("d/m/Y", $timestamp);
                    ?>
                    <tr>
                        <td><?=$contacts[$i]->getNome();?></td>
                        <td><?=$new_date?></td>
                        <td><?=$contacts[$i]->getEmail();?></td>
                        <td><?=$contacts[$i]->getCelular();?></td>
                        <td>
                            <button id="editContact" data-id="<?=$contacts[$i]->getId();?>" onclick="findContact(this)">
                                <img src="../media/editar.png" height="20px" alt="">
                            </button>
                            <button data-id="<?=$contacts[$i]->getId();?>" onclick="removeContact(this)">
                                <img src="../media/excluir.png" height="20px" alt="">
                            </button>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>Termos | Políticas</p>
        <div>
            <p>&copy; Copyright | Desenvolvido por</p>
            <img src="../media/logo_rodape_alphacode.png" alt="">
        </div>
        <p>&copy;Alphacode IT Solutions 2022</p>
    </footer>
</body>
</html>