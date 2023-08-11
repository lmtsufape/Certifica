var select_perfil = document.getElementById("select_perfil");
var divUnidadeADM = document.getElementById("unidade_administrativa");
var divTelefone = document.getElementById("divTelefone");
var divCpf = document.getElementById("divCpf");

var cpf = document.getElementById("cpf");
var fone = document.getElementById("telefone");

divUnidadeADM.style.display = "none"
divTelefone.style.display = ""
divCpf.style.display = ""

select_perfil.addEventListener("change", (e) => {
    if (e.target.value == 3) {
        divUnidadeADM.style.display = ""
        divTelefone.style.display = "none"
        divCpf.style.display = "none"
        cpf.removeAttribute("required")
        fone.removeAttribute("required")
    } else {
        divUnidadeADM.style.display = "none"
        divTelefone.style.display = ""
        divCpf.style.display = ""
        cpf.setAttribute("required")
        fone.setAttribute("required")
    }
})