
    document.getElementById('formulario').addEventListener('submit', function(event) {
        
        let isValid = true;

        // Validação do CNPJ 
        let cnpj = document.getElementById('cnpj').value;
        const cnpjRegex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/;
        if (!cnpjRegex.test(cnpj)) {
            alert('Insira um CNPJ válido! Ex: 44.555.888/0001-12');
            isValid = false;
          }

        // Validação do e-mail
        let email = document.getElementById('email').value;
        let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!email.match(emailRegex)) {
            alert('O e-mail está em um formato inválido. Digite algo como nome@provedor.com');
            isValid = false;
        }

        // Validação do telefone/celular
        let contato = document.getElementById('contato').value;
        let contatoRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/; // Exemplo: (11) 98765-4321
        if (!contato.match(contatoRegex)) {
            alert('O telefone/celular está em um formato inválido. Exemplo: (11) 98765-4321');
            isValid = false;
        }

        // Validação do CEP
        let cep = document.getElementById('cep').value;
        let cepRegex = /^\d{5}-\d{3}$/; // Exemplo: 12345-678
        if (!cep.match(cepRegex)) {
            alert('O CEP está em um formato inválido. Exemplo: 12345-678');
            isValid = false;
        }

        //// Se alguma validação falhou, impedir o envio
        if (!isValid) {
            event.preventDefault();
        }
    });
