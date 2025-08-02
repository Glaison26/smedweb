<?php

session_start();

$formato = $_GET['formato'] ?? 'html';

try {
    // conexão dom o banco de dados
    include("..\conexao.php");

    $atestado = $_SESSION['atestado'];
    $html = gerarHTMLAtestado($atestado);

    if ($formato === 'pdf') {
        gerarPDF($html, $atestado);
    } else {
        echo $html;
    }
} catch (Exception $e) {
    die('Erro: ' . $e->getMessage());
}

function gerarHTMLAtestado($atestado)
{
    $data_atual = date('d/m/Y');
    $paciente = $_SESSION['paciente'] ?? 'Paciente Desconhecido';
  
    return "
    <!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Atestado Médico - " . $paciente . "'</title>
        <style>
            body {
                font-family: 'Times New Roman', serif;
                max-width: 800px;
                margin: 0 auto;
                padding: 40px;
                line-height: 1.6;
                color: #333;
                background: white;
            }
            
            .header {
                text-align: center;
                margin-bottom: 40px;
                border-bottom: 3px solid #2c3e50;
                padding-bottom: 20px;
            }
            
            .logo {
                font-size: 2.5rem;
                color: #2c3e50;
                margin-bottom: 10px;
            }
            
            .clinica-nome {
                font-size: 1.8rem;
                font-weight: bold;
                color: #2c3e50;
                margin-bottom: 5px;
            }
            
            .clinica-info {
                font-size: 1rem;
                color: #666;
            }
            
            .titulo {
                text-align: center;
                font-size: 2rem;
                font-weight: bold;
                color: #2c3e50;
                margin: 40px 0;
                text-transform: uppercase;
                letter-spacing: 2px;
            }
            
            .conteudo {
                font-size: 1.2rem;
                text-align: justify;
                margin: 30px 0;
                padding: 20px;
                background: #f8f9fa;
                border-left: 5px solid #3498db;
            }
            
            .paciente {
                font-weight: bold;
                color: #2c3e50;
            }
            
            .assinatura {
                margin-top: 60px;
                text-align: center;
            }
            
            .linha-assinatura {
                border-top: 2px solid #333;
                width: 300px;
                margin: 40px auto 10px;
            }
            
            .medico-info {
                font-size: 1rem;
                color: #666;
            }
            
            .rodape {
                margin-top: 50px;
                text-align: center;
                font-size: 0.9rem;
                color: #888;
                border-top: 1px solid #ddd;
                padding-top: 20px;
            }
            
            .data-emissao {
                text-align: right;
                margin-top: 30px;
                font-size: 1.1rem;
                color: #666;
            }
            
            @media print {
                body {
                    padding: 20px;
                }
                .no-print {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class='header'>
            <div class='logo'>⚕️</div>
            <div class='clinica-nome'>Clínica Médica São Paulo</div>
            <div class='clinica-info'>
                CRM: 123.456.789 | CNPJ: 12.345.678/0001-90<br>
                Rua das Flores, 123 - Centro - São Paulo/SP<br>
                Telefone: (11) 3456-7890 | Email: contato@clinicasp.com.br
            </div>
        </div>
        
        <h1 class='titulo'>Atestado Médico</h1>
        
        <div class='conteudo'>
            <p>Atesto para os devidos fins que o(a) paciente <span class='paciente'>{$paciente}</span> esteve sob meus cuidados médicos.</p>
            
            <p><strong>Descrição:</strong> {$atestado}</p>
            
            <p>Este atestado é válido para todos os fins legais e administrativos necessários.</p>
        </div>
        
        <div class='data-emissao'>
            São Paulo, {$data_atual}
        </div>
        
        <div class='assinatura'>
            <div class='linha-assinatura'></div>
            <div class='medico-info'>
                <strong>Dr. João Silva</strong><br>
                CRM-SP: 123.456<br>
                Clínico Geral
            </div>
        </div>
        
        <div class='rodape'>
            <p>Atestado gerado em: {$data_atual} </p>
            <p>Este documento possui validade legal conforme legislação vigente.</p>
        </div>
        
        <div class='no-print' style='text-align: center; margin-top: 30px;'>
            <button onclick='window.print()' style='padding: 10px 20px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem;'>
                🖨️ Imprimir Atestado
            </button>
            <button onclick='window.close()' style='padding: 10px 20px; background: #95a5a6; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; margin-left: 10px;'>
                ✖️ Fechar
            </button>
        </div>
    </body>
    </html>";
}

function gerarPDF($html, $atestado)
{
    // Para gerar PDF, vamos usar uma abordagem simples com headers
    // Em um ambiente de produção, seria recomendado usar bibliotecas como TCPDF ou FPDF

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="atestado_' . $atestado['id'] . '_' . date('Y-m-d') . '.pdf"');

    // Como não temos uma biblioteca PDF instalada, vamos retornar o HTML
    // que pode ser convertido para PDF pelo navegador
    echo $html;
    echo "
    <script>
        window.onload = function() {
            window.print();
        }
    </script>";
}
?>



?>