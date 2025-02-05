<?php
// conectando ao banco de dads
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_empresas";

// criando a conexao
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);

}

// Funções para validação
function validarCNPJ($cnpj) {
    return preg_match("/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/", $cnpj);
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarTelefone($telefone) {
    return preg_match("/^\(\d{2}\) \d{5}\-\d{4}$/", $telefone);
}

function validarCEP($cep) {
    return preg_match("/^\d{5}\-\d{3}$/", $cep);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aqui estamos recebendo os dados do formulário
    $nome_loja = $_POST['nome_loja'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $contato = $_POST['contato'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // bloco que processa o upload da logomarca
    $logomarca = "";
    if (isset($_FILES['logomarca']) && $_FILES['logomarca']['error'] == 0) {
        $target_dir = "uploads/"; // Pasta que armazena a imagem
        $target_file = $target_dir . basename($_FILES["logomarca"]["name"]);
        move_uploaded_file($_FILES["logomarca"]["tmp_name"], $target_file);
        $logomarca = $target_file; // Caminho da imagem
    }

    if (empty($nome_loja)) {
        $erros[] = "O nome da loja é obrigatório.";
    }
    if (!validarCNPJ($cnpj)) {
        $erros[] = "CNPJ inválido. O formato correto é 00.000.000/0000-00.";
    }
    if (!validarEmail($email)) {
        $erros[] = "E-mail inválido.";
    }
    if (!validarTelefone($contato)) {
        $erros[] = "Telefone inválido. O formato correto é (00) 00000-0000.";
    }
    if (!validarCEP($cep)) {
        $erros[] = "CEP inválido. O formato correto é 00000-000.";
    }

    // Prepara a consulta SQL para inserir os dados no banco
    $stmt = $conn->prepare("INSERT INTO empresas (nome_loja, cnpj, email, contato, cep, rua, numero, complemento, bairro, cidade, estado, logomarca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $nome_loja, $cnpj, $email, $contato, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $logomarca);

    
    // Executar a consulta para ver se os dados foram cadastrados com sucesso

    if ($stmt->execute()) {
        // Dados cadastrados com sucesso
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Cadastro Realizado</title>
            <link rel='stylesheet' href='css/style.css?=".time()."'>
        </head>
        <body>
            <div class='form-container'>
                <h1>Cadastro realizado com sucesso!</h1>
                <h3 class='titulo-retorno'>Dados Cadastrados:</h3>
                <ul>
                    <li><strong class='titulo-retorno'>Nome da Loja:</strong> $nome_loja</li>
                    <li><strong class='titulo-retorno'>CNPJ:</strong> $cnpj</li>
                    <li><strong class='titulo-retorno'>E-mail:</strong> $email</li>
                    <li><strong class='titulo-retorno'>Contato:</strong> $contato</li>
                    <li><strong class='titulo-retorno'>CEP:</strong> $cep</li>
                    <li><strong class='titulo-retorno'>Rua:</strong> $rua</li>
                    <li><strong class='titulo-retorno'>Número:</strong> $numero</li>
                    <li><strong class='titulo-retorno'>Complemento:</strong> $complemento</li>
                    <li><strong class='titulo-retorno'>Bairro:</strong> $bairro</li>
                    <li><strong class='titulo-retorno'>Cidade:</strong> $cidade</li>
                    <li><strong class='titulo-retorno'>Estado:</strong> $estado</li>
                </ul>
                <a href='index.php' class='back-button'>Voltar para a página inicial</a>
                <a href='listar-empresas.php' class='back-button'>Listar empresas cadastradas</a>
            </div>
        </body>
        </html>";
    } else {
        // Caso dê erro no cadastro
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Erro no Cadastro</title>
            <link rel='stylesheet' href='css/style.css'>
        </head>
        <body>
            <div class='form-container'>
                <h1>Erro ao cadastrar</h1>
                <p>" . $stmt->error . "</p>
                <a href='index.html' class='back-button'>Tentar novamente</a>
            </div>
        </body>
        </html>";
    }
   

    // Fechando a conexão
    $stmt->close();
    $conn->close();
}
?>
