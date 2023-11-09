//checkbox do passaporte e cpf

var checkbox = document.getElementsByName('cpf_pass')

//divs
var passaporte_div = document.getElementById('passaporte_dinamico')
var cpf_div = document.getElementById('cpf_dinamico')

var cpf = document.getElementById('cpf')
var passaporte = document.getElementById('passaporte')



//cpf
checkbox[0].addEventListener('click',(e)=>{
    passaporte.removeAttribute("required")
    passaporte_div.classList.remove("camporegister_dinamico_show")
    passaporte_div.classList.add("camporegister_dinamico_hide")

    cpf.setAttribute('required', '')
    cpf_div.classList.remove("camporegister_dinamico_hide")
    cpf_div.classList.add("camporegister_dinamico_show")
})

//passaporte
checkbox[1].addEventListener('click',(e)=>{
    cpf.removeAttribute("required")
    cpf_div.classList.remove("camporegister_dinamico_show")
    cpf_div.classList.add("camporegister_dinamico_hide")

    passaporte.setAttribute('required', '')
    passaporte_div.classList.remove("camporegister_dinamico_hide")
    passaporte_div.classList.add("camporegister_dinamico_show")
})

//validação com alerta


