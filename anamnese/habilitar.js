// função para habilitar e desabilitar  os campos de acordo com a seleção do usuário
function habilitacao() {
    // pegando os elementos do formulário
    // uso de epi
    var uso_epi_sim = document.getElementById("c_uso_epi_sim");
    var qual_epi = document.getElementById("c_qual_epi");
    // hipertensão
    var hipertensao_sim = document.getElementById("c_hipertensao_sim");
    var hipertensao_obs = document.getElementById("c_hipertensao_obs");
    // diabetes
    var diabetes_sim = document.getElementById("c_diabetes_sim");
    var diabetes_obs = document.getElementById("c_diabetes_obs");
    // doenças cardiovasculares
    var doencas_cardiovasculares_sim = document.getElementById("c_doencas_cardiovasculares_sim");
    var doencas_cardiovasculares_obs = document.getElementById("c_doencas_cardiovasculares_obs");
    // asma / bronquite
    var asma_bronquite_sim = document.getElementById("c_asma_bronquite_sim");
    var asma_bronquite_obs = document.getElementById("c_asma_bronquite_obs");
    // doenças renais
    var doencas_renais_sim = document.getElementById("c_doencas_renais_sim");
    var doencas_renais_obs = document.getElementById("c_doencas_renais_obs");
    // doenças neurológicas
    var doencas_neurologicas_sim = document.getElementById("c_doencas_neurologicas_sim");
    var doencas_neurologicas_obs = document.getElementById("c_doencas_neurologicas_obs");
    // disturbios psiquiátricos
    var disturbios_psiquiatricos_sim = document.getElementById("c_disturbios_psiquiatricos_sim");
    var disturbios_psiquiatricos_obs = document.getElementById("c_disturbios_psiquiatricos_obs");
    // cancer
    var cancer_sim = document.getElementById("c_cancer_sim");
    var cancer_obs = document.getElementById("c_cancer_obs");
    // alergias
    var alergias_sim = document.getElementById("c_alergias_sim");
    var alergias_obs = document.getElementById("c_alergias_obs");
    // cirurgias previas
    var cirurgias_previas_sim = document.getElementById("c_cirurgias_previas_sim");
    var cirurgias_previas_obs = document.getElementById("c_cirurgias_previas_obs");
    // tabagismo
    var tabagismo_sim = document.getElementById("c_tabagismo_sim");
    var cigarros_dia = document.getElementById("c_cigarros_dia");
    var cigarros_tempo = document.getElementById("c_tempo_tabagismo");
    // Etilismo
    var alcoolismo_sim = document.getElementById("c_alcoolismo_sim");
    var alcool_semana = document.getElementById("c_alcool_semana");
   
    // limpando os campos de observação e desabilitando-os

    // verificando se o radio button "Sim" está selecionado para epi
    if (uso_epi_sim.checked) {
        qual_epi.disabled = false;
        qual_epi.focus();
    } else {
        qual_epi.value = "";
        qual_epi.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para hipertensão
    if (hipertensao_sim.checked) {
        hipertensao_obs.disabled = false;
        hipertensao_obs.focus();
    } else {
        hipertensao_obs.value = "";
        hipertensao_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para diabetes
    if (diabetes_sim.checked) {
        diabetes_obs.disabled = false;
        diabetes_obs.focus();
    } else {
        diabetes_obs.value = "";
        diabetes_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para doenças cardiovasculares
    if (doencas_cardiovasculares_sim.checked) {
        doencas_cardiovasculares_obs.disabled = false;
        doencas_cardiovasculares_obs.focus();
    } else {
        doencas_cardiovasculares_obs.value = "";
        doencas_cardiovasculares_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para asma / bronquite
    if (asma_bronquite_sim.checked) {
        asma_bronquite_obs.disabled = false;
        asma_bronquite_obs.focus();
    } else {
        asma_bronquite_obs.value = "";
        asma_bronquite_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para doenças renais
    if (doencas_renais_sim.checked) {
        doencas_renais_obs.disabled = false;
        doencas_renais_obs.focus();
    } else {
        doencas_renais_obs.value = "";
        doencas_renais_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para doenças neurológicas
    if (doencas_neurologicas_sim.checked) {
        doencas_neurologicas_obs.disabled = false;
        doencas_neurologicas_obs.focus();
    } else {
        doencas_neurologicas_obs.value = "";
        doencas_neurologicas_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para disturbios psiquiátricos
    if (disturbios_psiquiatricos_sim.checked) {
        disturbios_psiquiatricos_obs.disabled = false;
        disturbios_psiquiatricos_obs.focus();
    } else {
        disturbios_psiquiatricos_obs.value = "";
        disturbios_psiquiatricos_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para cancer
    if (cancer_sim.checked) {
        cancer_obs.disabled = false;
        cancer_obs.focus();
    } else {
        cancer_obs.value = "";
        cancer_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para alergias
    if (alergias_sim.checked) {
        alergias_obs.disabled = false;
        alergias_obs.focus();
    } else {
        alergias_obs.value = "";
        alergias_obs.disabled = true;
    }
    // verificando se o radio button "Sim" está selecionado para cirurgias previas
    if (cirurgias_previas_sim.checked) {
        cirurgias_previas_obs.disabled = false;
        cirurgias_previas_obs.focus();
    } else {
        cirurgias_previas_obs.value = "";
        cirurgias_previas_obs.disabled = true;
    }
    // verificando se o radio button "sim" está selecionado para tabagismo
    if (tabagismo_sim.checked) {
        cigarros_dia.disabled = false;
        cigarros_dia.focus();
        cigarros_tempo.disabled = false;
    } else {
        cigarros_dia.disabled = true;
        cigarros_tempo.disabled = true;
        cigarros_dia.value = "";
        cigarros_tempo.value = "";
    }
    // verificando se o radio button "sim" está selecionado para alcoolismo
    if (alcoolismo_sim.checked){
        alcool_semana.disabled = false;
        alcool_semana.focus();
    } else{
        alcool_semana.disabled = true;
        alcool_semana.value = "";
    }
}
