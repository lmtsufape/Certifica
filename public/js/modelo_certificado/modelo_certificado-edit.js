
//Preview fundo
var imgFundo = document.getElementById('img_fundo');
var imgFundoNew = document.getElementById('img_fundo_new');
var planoFundo = document.getElementById('plano_fundo');


imgFundoNew.style.display = "none"

planoFundo.addEventListener('change', (e) => {

    imgFundo.style.display = "none"
    imgFundoNew.style.display = ""

    imgFundoNew.src = URL.createObjectURL(e.target.files[0])
})

//Preview verso

var imgVerso = document.getElementById('img_verso');
var imgVersoNew = document.getElementById('img_verso_new');
var planoVerso = document.getElementById('plano_verso');

imgVersoNew.style.display = "none"

planoVerso.addEventListener('change', (e) => {
    imgVerso.style.display = "none"
    imgVersoNew.style.display = ""

    imgVersoNew.src = URL.createObjectURL(e.target.files[0])
})

//Preview logo

var imgLogo = document.getElementById('img_logo');
var imgLogoNew = document.getElementById('img_logo_new');
var planoLogo = document.getElementById('plano_logo');

imgLogoNew.style.display = "none"

planoLogo.addEventListener('change', (e) => {
    imgLogo.style.display = "none"
    imgLogoNew.style.display = ""

    imgLogoNew.src = URL.createObjectURL(e.target.files[0])
})

const select_tipo_certificado = document.getElementById("select_tipo_certificado");
const outro_tipo_certificado = document.getElementById("outro_tipo_certificado");

select_tipo_certificado.addEventListener("change", function () {
    if (select_tipo_certificado.value === "Outro") {
        outro_tipo_certificado.style.display = "block";
    } else {
        outro_tipo_certificado.style.display = "none";
    }
});
