var selectPerfil = document.getElementById("select_perfil");
var divsiape = document.getElementById("siape");
var cursosaluno = document.getElementById("cursos_aluno");
var cursosprof = document.getElementById("professor_cursos");

selectPerfil.addEventListener("change", (e) => {

    if (e.target.value == 4) {
        //campo siape
        divsiape.classList.add("camporegister_dinamico_hide")
        divsiape.classList.remove("camporegister_dinamico_show")
        //campo cursos estudantes
        cursosaluno.classList.remove("camporegister_dinamico_hide")
        cursosaluno.classList.add("camporegister_dinamico_show")
        //campo cursos professores
        cursosprof.classList.remove("camporegister_dinamico_show")
        cursosprof.classList.add("camporegister_dinamico_hide")

    } else if (e.target.value == 2) {
        //campo siape
        divsiape.classList.remove("camporegister_dinamico_hide")
        divsiape.classList.add("camporegister_dinamico_show")
        //campo cursos estudantes
        cursosaluno.classList.remove("camporegister_dinamico_show")
        cursosaluno.classList.add("camporegister_dinamico_hide")
        //campo cursos professores
        cursosprof.classList.remove("camporegister_dinamico_hide")
        cursosprof.classList.add("camporegister_dinamico_show")

    } else if (e.target.value == 0) {

        //campo siape
        divsiape.classList.remove("camporegister_dinamico_hide")
        divsiape.classList.add("camporegister_dinamico_show")
        //campo cursos estudantes
        cursosaluno.classList.remove("camporegister_dinamico_show")
        cursosaluno.classList.add("camporegister_dinamico_hide")
        //campo cursos professores
        cursosprof.classList.remove("camporegister_dinamico_show")
        cursosprof.classList.add("camporegister_dinamico_hide")
    }
})

//campo outros 

var select_instituicao = document.getElementById("select_instituicao");
var outra_instituicao = document.getElementById("outra_instituicao");

select_instituicao.addEventListener("change", (e) => {

    if (e.target.value == 1) {
        outra_instituicao.classList.remove("camporegister_dinamico_show")
        outra_instituicao.classList.add("camporegister_dinamico_hide")
    } else {
        outra_instituicao.classList.remove("camporegister_dinamico_hide")
        outra_instituicao.classList.add("camporegister_dinamico_show")
    }
})


//checkbox do passaporte e cpf

var checkbox = document.getElementsByName('cpf_pass')

//divs
var passaporte_div = document.getElementById('passaporte_dinamico')
var cpf_div = document.getElementById('cpf_dinamico')


//cpf
checkbox[0].addEventListener('click',(e)=>{
    passaporte_div.classList.remove("camporegister_dinamico_show")
    passaporte_div.classList.add("camporegister_dinamico_hide")

    cpf_div.classList.remove("camporegister_dinamico_hide")
    cpf_div.classList.add("camporegister_dinamico_show")
})

//passaporte
checkbox[1].addEventListener('click',(e)=>{
    cpf_div.classList.remove("camporegister_dinamico_show")
    cpf_div.classList.add("camporegister_dinamico_hide")

    passaporte_div.classList.remove("camporegister_dinamico_hide")
    passaporte_div.classList.add("camporegister_dinamico_show")

})






