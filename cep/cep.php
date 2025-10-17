<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Busca de Endereço por CEP</title>
</head>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cepInput = document.getElementById('cep');

        // Adiciona um ouvinte de evento para quando o campo de CEP perder o foco
        cepInput.addEventListener('blur', () => {
            let cep = cepInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            // Verifica se o campo CEP possui valor informado
            if (cep) {
                // Faz a requisição usando a Fetch API
                fetch('https://viacep.com.br/ws/' + cep + '/json', {
                        method: 'GET',
                        mode: 'cors', // Adicione para lidar com problemas de CORS
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.erro) {
                            alert('CEP não encontrado.');
                            return;
                        }
                        document.getElementById('rua').textContent = data.logradouro;
                        document.getElementById('bairro').textContent = data.bairro;
                        document.getElementById('localidade').textContent = data.localidade;
                        document.getElementById('uf').textContent = data.uf;
                    })
                    .catch(error => {
                        alert('Erro ao buscar o CEP.');
                        console.error('Erro:', error);
                    });
            }
        });

        // Função para limpar os campos do formulário
        function limpaFormulario() {
            document.getElementById('rua').value = '';
            document.getElementById('bairro').value = '';
            document.getElementById('cidade').value = '';
            document.getElementById('uf').value = '';
        }
    });
</script>

<body>

    <h1>Preencher endereço por CEP</h1>

    <form id="form-cep">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000">
        <br><br>

        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua">
        <br><br>

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro">
        <br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">
        <br><br>

        <label for="uf">Estado:</label>
        <input type="text" id="uf" name="uf">
        <br><br>
    </form>


</body>

</html>