var select_perfil = document.getElementById("select_perfil");
var perfil_selecionado = document.getElementById("perfil_selecionado");
var divUnidadeADM = document.getElementById("unidade_administrativa");

if (perfil_selecionado.value == 3) {
    divUnidadeADM.style.visibility = ""
} else {
    divUnidadeADM.style.visibility = "hidden"
}

select_perfil.addEventListener("change", (e) => {
    if (e.target.value == 3) {
        divUnidadeADM.style.visibility = ""
    } else {
        divUnidadeADM.style.visibility = "hidden"
    }
})