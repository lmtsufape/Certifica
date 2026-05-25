var select_perfil = document.getElementById("select_perfil");
var divUnidadeADM = document.getElementById("unidade_administrativa");
var divTelefone = document.getElementById("divTelefone");
var divCpf = document.getElementById("divCpf");
var select_passaporte_cpf = document.getElementById("select_pass_cpf")
var passaporte_div = document.getElementById('passaporte_dinamico')
var cpf_div = document.getElementById('divCpf')

var checkbox = document.getElementsByName('cpf_pass')

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
        select_passaporte_cpf.style.display = "none"

        
        fone.removeAttribute("required")
    } else {
        divUnidadeADM.style.display = "none"
        divTelefone.style.display = ""
        divCpf.style.display = ""
        passaporte_div.style.display = "none"
        select_passaporte_cpf.style.display = ""

        cpf.setAttribute("required")
        fone.setAttribute("required")
    }
})



passaporte_div.style.display = "none"

//cpf
checkbox[0].addEventListener('click',(e)=>{
    passaporte_div.style.display = "none"
    cpf_div.style.display = ""
})

//passaporte
checkbox[1].addEventListener('click',(e)=>{
    passaporte_div.style.display = ""
    cpf_div.style.display = "none"
})

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

