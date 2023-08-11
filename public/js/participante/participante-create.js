var div_Inst = document.getElementById("select_instituicao");
var div_outrasInst = document.getElementById("outra_instituicao");

div_outrasInst.style.visibility = "hidden"

div_Inst.addEventListener("change", (e) => {
    if (e.target.value == 1) {
        div_outrasInst.style.visibility = "hidden"
    } else if (e.target.value == 2) {
        div_outrasInst.style.visibility = ""
    }
})