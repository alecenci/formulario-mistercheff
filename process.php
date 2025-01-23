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
        echo "<h2>Cadastro realizado com sucesso!</h2>";
        echo "<h3>Dados Cadastrados:</h3>";
        echo "<ul>
                <li><strong>Nome da Loja:</strong> $nome_loja</li>
                <li><strong>CNPJ:</strong> $cnpj</li>
                <li><strong>E-mail:</strong> $email</li>
                <li><strong>Contato:</strong> $contato</li>
                <li><strong>CEP:</strong> $cep</li>
                <li><strong>Rua:</strong> $rua</li>
                <li><strong>Número:</strong> $numero</li>
                <li><strong>Complemento:</strong> $complemento</li>
                <li><strong>Bairro:</strong> $bairro</li>
                <li><strong>Cidade:</strong> $cidade</li>
                <li><strong>Estado:</strong> $estado</li>
              </ul>";

    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
   

    // Fechando a conexão
    $stmt->close();
    $conn->close();
}
?>
