var select_perfil = document.getElementById("select_perfil");
var perfil_selecionado = document.getElementById("perfil_selecionado");
var divUnidadeADM = document.getElementById("unidade_administrativa");

if (divUnidadeADM) {
    if (perfil_selecionado.value == 3) {
        divUnidadeADM.style.visibility = ""
    } else {
        divUnidadeADM.style.visibility = "hidden"
    }
}

select_perfil.addEventListener("change", (e) => {
    if (divUnidadeADM) {
        divUnidadeADM.style.visibility = e.target.value == 3 ? "" : "hidden"
    }
})

var cpf = document.getElementById("cpf");
if (cpf) {
    cpf.addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '').slice(0, 11)
        if (value.length > 9) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4')
        } else if (value.length > 6) {
            value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3')
        } else if (value.length > 3) {
            value = value.replace(/(\d{3})(\d{1,3})/, '$1.$2')
        }
        this.value = value
    })
}