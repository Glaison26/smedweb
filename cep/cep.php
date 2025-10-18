<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Busca de Endereço por CEP</title>
</head>


<body>

<script>
  
        document.addEventListener('DOMContentLoaded', () => {
            const cepInput = document.getElementById('cep');

            // Adiciona um ouvinte de evento para quando o campo de CEP perder o foco
            cepInput.addEventListener('blur', () => {
                let cep = cepInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                // Verifica se o campo CEP possui valor informado
                
                if (cep) {
                  

                    // Faz a requisição usando a Fetch API

                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.erro) {
                                alert('CEP não encontrado.');
                                return;
                            }
                            document.getElementById('logradouro').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('uf').value = data.uf;
                        })
                        .catch(error => {
                            alert('Erro ao buscar o CEP.');
                            alert(error);
                            console.error('Erro:', error);
                        });
                }
            });

            // Função para limpar os campos do formulário
            function limpaFormulario() {
                document.getElementById('logradouro').value = '';
                document.getElementById('bairro').value = '';
                document.getElementById('cidade').value = '';
                document.getElementById('uf').value = '';
            }
        });
    </script>


    <h1>Preencher endereço por CEP</h1>

    <form id="form-cep">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep">

        <label for="logradouro">Rua:</label>
        <input type="text" id="logradouro" name="logradouro">

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro">

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">

        <label for="uf">UF:</label>
        <input type="text" id="uf" name="uf">
    </form>

</body>





</html>