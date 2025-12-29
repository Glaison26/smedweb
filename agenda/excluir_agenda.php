<?php
// Rotina para exclusão de registros da agenda filtrada por médico.
// Usa GET `medico_id` (e opcionalmente `medico_nome`) para identificar o médico.
// Ao submeter, mostra um resumo e a SQL de exclusão simulada. NÃO executa DELETE automaticamente.
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../conexao.php");
include("../links.php");

$result = '';
$error = '';$sql = '';

$medico_id = $_GET['id'] ?? '';
$medico_nome = $_GET['nome'] ?? '';

if (! $medico_id) {
    // Se nenhum médico foi passado, mostramos instruções simples.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmed = isset($_POST['confirm']) && $_POST['confirm'] === '1';
    $mode = $_POST['mode'] ?? '';

    if (! $confirmed) {
        $error = 'Você deve confirmar que entendeu os riscos antes de prosseguir.';
    } else {
        // Monta SQL exemplo com filtro por médico — NÃO executa.
        $whereMed = "id_profissional = '" . ($medico_id) . "'";
        echo 'codigo where'. $whereMed;
        switch ($mode) {
            case 'between':
                $from = $_POST['from_date'] ?? '';
                $to   = $_POST['to_date'] ?? '';
                $sql = "DELETE FROM agenda WHERE $whereMed AND data >= '$from' AND data <= '$to'";
                $sql_backup = "SELECT * from agenda where $whereMed AND data >= '$from' AND data <= '$to' and matricula <>''";
                break;
            case 'before':
                $before = $_POST['before_date'] ?? '';
                $sql = "DELETE FROM agenda WHERE $whereMed AND data &lt; '$before'";
                break;
            case 'lastdays':
                $days = intval($_POST['last_days'] ?? 0);
                $sql = "DELETE FROM agenda WHERE $whereMed AND data &lt; DATE_SUB(NOW(), INTERVAL $days DAY)";
                break;
            case 'all':
                $sql = "DELETE FROM agenda WHERE $whereMed";
                break;
            default:
                $error = 'Opção de período inválida.';
        }
    }
    // rotina para copiar os dias com agendamento para tabela lixeira
    //echo $sql_backup;
    $result = $conection->query($sql_backup);
    // loop para incluir dados na lixeira
    $i_contador = 0;
     while ($c_linha = $result->fetch_assoc()){
        // inserção dos registros
        $c_id_profissional = $c_linha['id_profissional'];
        $c_id_convenio = $c_linha['id_convenio'];
        $d_data = $c_linha['data'];
        $c_dia = $c_linha['dia'];
        $c_horario = $c_linha['horario'];
        $c_nome = $c_linha['Nome'];
        $c_telefone = $c_linha['telefone'];
        $c_email = $c_linha['email'];
        $c_observacao = $c_linha['observacao'];
        $c_matricula = $c_linha['matricula'];
        $c_paciente_novo = $c_linha['paciente_novo'];
        $c_paciente_compareceu = $c_linha['paciente_compareceu'];
        $c_paciente_atendido = $c_linha['paciente_compareceu'];
        $c_status = $c_linha['status'];
        // sql de inserção
        $c_sql_insere = "INSERT into lixeira_agenda (id_profissional,id_convenio,data,dia,horario,nome,telefone
        , email,observacao,matricula,paciente_novo, paciente_compareceu, paciente_atendido, status)
         value ('$c_id_profissional','$c_id_convenio','$d_data','$c_dia','$c_horario','$c_nome',
        '$c_telefone','$c_email','$c_observacao','$c_matricula','$c_paciente_novo','$c_paciente_compareceu',
        '$c_paciente_atendido', '$c_status')";
        $result_insere = $conection->query($c_sql_insere);
        $i_contador++;

     }
    // executo rotina para apagar os dados da agenda
    $result_delete = $conection->query($sql);


}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Excluir agenda por médico</title>
    <link rel="stylesheet" href="/css/basico.css">
    <style>
        .card{border:1px solid #ddd;padding:16px;border-radius:6px;max-width:820px;margin:20px auto}
        .danger{background:#fff3f3;border:1px solid #f5c2c2;padding:12px;margin-bottom:12px}
        .muted{color:#666}
        .row{display:flex;gap:8px;align-items:center}
        input[type=date], input[type=number]{padding:6px}
        .sql{background:#f7f7f7;border-left:4px solid #ddd;padding:8px;margin-top:8px;font-family:monospace}
        label.inline{display:inline-flex;align-items:center;gap:6px}
    </style>
</head>
<body>
<div class="card">
    <h2>Excluir registros da agenda por médico</h2>

    <?php if (! $medico_id): ?>
        <div class="danger">
            <strong>Atenção:</strong> Nenhum médico selecionado. Passe o parâmetro <code>medico_id</code> na URL.
            <div class="muted">Ex.: <a href="?medico_id=12&medico_nome=Dr.%20Silva">?medico_id=12&medico_nome=Dr.%20Silva</a></div>
        </div>
    <?php else: ?>

    <p><strong>Médico:</strong> <?php echo htmlspecialchars($medico_nome ?: $medico_id) ?> (id <?php echo htmlspecialchars($medico_id) ?>)</p>

    <div class="danger">
        <strong>Atenção — Riscos da exclusão:</strong>
        <ul>
            <li>Exclusões são permanentes e não podem ser desfeitas sem backup.</li>
            <li>Remover registros pode causar inconsistências em relatórios e histórico clínico.</li>
            <li>Recomenda-se exportar/backup dos dados antes de qualquer exclusão.</li>
            <li>Usuário deve confirmar expressamente que entendeu os riscos.</li>
        </ul>
    </div>

    <form method="post" id="delForm">
        <fieldset>
            <legend>Período para exclusão (filtrado pelo médico selecionado)</legend>
            <div>
                <label class="inline"><input type="radio" name="mode" value="between" checked> Entre datas</label>
                <div class="row" style="margin:6px 0 12px 18px">
                    <label>De <input type="date" name="from_date" id="from_date"></label>
                    <label>Até <input type="date" name="to_date" id="to_date"></label>
                </div>

                <label class="inline"><input type="radio" name="mode" value="before"> Anteriores a</label>
                <div class="row" style="margin:6px 0 12px 18px">
                    <label>Data <input type="date" name="before_date" id="before_date" disabled></label>
                </div>

                <label class="inline"><input type="radio" name="mode" value="lastdays"> Mais antigos que (dias)</label>
                <div class="row" style="margin:6px 0 12px 18px">
                    <input type="number" name="last_days" id="last_days" min="1" value="30" disabled>
                </div>

                <label class="inline"><input type="radio" name="mode" value="all"> Excluir todos os registros deste médico (PERIGOSO)</label>
            </div>
        </fieldset>

        <div style="margin-top:12px">
            <label class="inline"><input type="checkbox" name="confirm" value="1" id="confirm"> Eu li e entendo os riscos descritos acima.</label>
        </div>

        <div style="margin-top:12px">
            <button type="submit" id="submitBtn" disabled style="background:#c82333;color:#fff;border:none;padding:8px 12px;border-radius:4px">Confirmar exclusão (mostrar resumo)</button>
            <a href="\smedweb/agenda/config_agenda.php" style="margin-left:8px">Cancelar</a>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="danger" style="margin-top:12px"><strong>Erro:</strong> <?php echo $error ?></div>
    <?php endif; ?>

    <?php if ($sql): ?>
        <div style="margin-top:12px">
            <strong>Resultado :</strong>
            <div class="sql"><?php echo $sql ?></div>
            <p class="muted">Operação realizada com sucesso!!! <?php echo 'Foram movidos '. $i_contador. ' agendamento para a lixeira.'?></p>
        </div>
    <?php endif; ?>

    <?php endif; ?>

</div>

<script>
    const form = document.getElementById('delForm');
    const confirmBox = document.getElementById('confirm');
    const submitBtn = document.getElementById('submitBtn');
    const modeInputs = document.querySelectorAll('input[name="mode"]');

    const fromDate = document.getElementById('from_date');
    const toDate = document.getElementById('to_date');
    const beforeDate = document.getElementById('before_date');
    const lastDays = document.getElementById('last_days');

    function updateEnabled() {
        const mode = document.querySelector('input[name="mode"]:checked').value;
        fromDate.disabled = toDate.disabled = (mode !== 'between');
        beforeDate.disabled = (mode !== 'before');
        lastDays.disabled = (mode !== 'lastdays');
    }

    modeInputs.forEach(i=>i.addEventListener('change', updateEnabled));
    updateEnabled();

    confirmBox && confirmBox.addEventListener('change', ()=>{
        submitBtn.disabled = !confirmBox.checked;
    });

    // Pequena validação antes de enviar
    form && form.addEventListener('submit', function(e){
        const mode = document.querySelector('input[name="mode"]:checked').value;
        if (!confirmBox.checked) { e.preventDefault(); alert('Confirme que entendeu os riscos.'); return; }
        if (mode === 'between') {
            if (!fromDate.value || !toDate.value) { e.preventDefault(); alert('Informe as duas datas.'); return; }
            if (fromDate.value > toDate.value) { e.preventDefault(); alert('Data de início maior que a data fim.'); return; }
        }
        if (mode === 'before' && !beforeDate.value) { e.preventDefault(); alert('Informe a data.'); return; }
        if (mode === 'lastdays' && (!lastDays.value || lastDays.value < 1)) { e.preventDefault(); alert('Informe um número de dias válido.'); return; }
    });
</script>

</body>
</html>
