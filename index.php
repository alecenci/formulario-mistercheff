<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresas</title>
    <link rel="stylesheet" href="../formulario-mistercheff/css/style.css?=<?=time()?>">
</head>
<body>
    <div class="logo">
        <img class="img-logo"src="img/logo_mistercheff.png" alt="">
    </div>
    
    <div class="form-container">
        <h1>Cadastro de Empresas</h1>
        <form id="formulario" action="process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome da Loja</label>
                <input type="text" id="nome" name="nome_loja" placeholder="Digite o nome da loja" required>
            </div>
            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" id="cnpj" name="cnpj" placeholder="Digite o CNPJ (Apenas números)" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite o e-mail Ex: nome@provedor.com" required>
            </div>
            <div class="form-group">
                <label for="contato">Contato</label>
                <input type="text" id="contato" name="contato" placeholder="Digite o telefone/celular (xx) xxxxx-xxxx" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" placeholder="Digite o CEP Ex: 00000-000" required>
            </div>
            <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" id="rua" name="rua" placeholder="Digite a rua" required>
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <input type="text" id="numero" name="numero" placeholder="Digite o número" required>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento" placeholder="Digite o complemento (opcional)">
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" placeholder="Digite o estado" required>
            </div>
            <div class="form-group">
                <label for="logomarca">Upload da Logomarca</label>
                <input type="file" id="logomarca" name="logomarca" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
          $('#cnpj').mask('00.000.000/0000-00');
          $('#contato').mask('(00) 00000-0000');
          $('#cep').mask('00000-000');

        });
        </script>
    <script src="scripts.js"></script>
</body>
</html>