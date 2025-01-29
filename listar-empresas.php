<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_empresas";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM empresas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empresas</title>
    <link rel="stylesheet" href="../formulario-mistercheff/css/style.css?=<?=time()?>">
</head>
<body>
    <h1 class="titulo-lista-empresas" >Empresas Cadastradas</h1>
    <div class=.table-container>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Loja</th>
                    <th>CNPJ</th>
                    <th>Email</th>
                    <th>Contato</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Logomarca</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($empresa = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($empresa['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['nome_loja']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['cnpj']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['contato']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['cep']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['rua']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['numero']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['complemento']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['bairro']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['cidade']) . "</td>";
                        echo "<td>" . htmlspecialchars($empresa['estado']) . "</td>";
                        
                        //exibe logo marca
                        if (!empty($empresa['logomarca'])) {
                            echo "<td><img src='" . htmlspecialchars($empresa['logomarca']) . "' alt='Logomarca' width='50'></td>";
                        } else {
                            echo "<td>Sem logomarca</td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>Nenhuma empresa cadastrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div> 
    <a href='index.php' class='back-button'>Voltar para a página inicial</a>
</body>
</html>

<?php
$conn->close();
?>