document.addEventListener('DOMContentLoaded', () => {
    const cepInput = document.getElementById('cep');

    // Adiciona um ouvinte de evento para quando o campo de CEP perder o foco
    cepInput.addEventListener('blur', () => {
        let cep = cepInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

        // Verifica se o campo CEP possui valor informado
        if (cep) {
            const url = `https://viacep.com.br/ws/${cep}/json/`;

            // Faz a requisição usando a Fetch API
            fetch(url)
                .then(response => response.json()) // Converte a resposta para JSON
                .then(data => {
                    // Se o CEP for válido e encontrado, preenche os campos do formulário
                    if (!data.erro) {
                        document.getElementById('endereco').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                       // document.getElementById('uf').value = data.uf;
                    } else {
                        // Se o CEP não for encontrado, exibe um alerta e limpa os campos
                        alert('CEP não encontrado. Por favor, verifique o número.');
                        limpaFormulario();
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    alert('Ocorreu um erro na busca. Tente novamente mais tarde.');
                    limpaFormulario();
                });
        }
    });

    // Função para limpar os campos do formulário
    function limpaFormulario() {
        document.getElementById('endereco').value = '';
        document.getElementById('bairro').value = '';
        document.getElementById('cidade').value = '';
      //  document.getElementById('uf').value = '';
    }
});
