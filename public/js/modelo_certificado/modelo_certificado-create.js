//Preview fundo
var imgFundo = document.getElementById('img_fundo');
var planoFundo = document.getElementById('plano_fundo');
var textFundo = document.getElementById('text_fundo');

imgFundo.style.display = "none"

planoFundo.addEventListener('change', (e) => {
    textFundo.style.display = "none"
    imgFundo.style.display = ""

    imgFundo.src = URL.createObjectURL(e.target.files[0])
})

//Preview verso

var imgVerso = document.getElementById('img_verso');
var planoVerso = document.getElementById('plano_verso');
var textVerso = document.getElementById('text_verso');

imgVerso.style.display = "none"

planoVerso.addEventListener('change', (e) => {
    textVerso.style.display = "none"
    imgVerso.style.display = ""

    imgVerso.src = URL.createObjectURL(e.target.files[0])
})

//Preview logo

var imglogo = document.getElementById('img_logo');
var planologo = document.getElementById('plano_logo');
var textlogo = document.getElementById('text_logo');

imglogo.style.display = "none"

planologo.addEventListener('change', (e) => {
    textlogo.style.display = "none"
    imglogo.style.display = ""

    imglogo.src = URL.createObjectURL(e.target.files[0])
})