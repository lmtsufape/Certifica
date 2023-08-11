
const select_atividade = document.getElementById("select_atividade");
const outra_atividade = document.getElementById("outra_atividade");

$("#select_atividade").change(function() {
    if (select_atividade.value === "Outra") {
        outra_atividade.style.display = "block";
    } else {
        outra_atividade.style.display = "none";
    }
});
