////////////////GLOBAL/////////////////////////
function previewImage(event){
    var reader = new FileReader();
    var imageField = document.getElementById("image-field")

    reader.onload = function(){
        if(reader.readyState == 2){
            imageField.src = reader.result;
        }
    }

    reader.readAsDataURL(event.target.files[0]);
}

////////////////LOGIN/////////////////////////
function hideLogin() {
    var x = document.getElementById("logIn");
    var y = document.getElementById("signUp");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none";
    } else {
        x.style.display = "none";
        y.style.display = "block";
    }
}

function validarContraseña(){
    var inputPassword = document.getElementById("password").value;
    var invalid = document.getElementsByClassName('invalid')[0];

    invalid.style.display = "none";
    alert(inputPassword.value);
    //Minimo 8 caracteres
    if (inputPassword.length < 8) {
        invalid.style.display = "block";
        invalid.innerHTML = "Debe de haber almenos 8 caracteres";
        return false;
    }
    
    var mayusculas="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var numeros="0123456789";
    var caracteres="@¡”#$%&/=’?¡¿:;,.-_+*{][}";
    var tieneMayuscula = false;
    var tieneNumeros = false;
    var tieneCaracteres = false;
    for(i = 0; i < inputPassword.length; i++){
        if (mayusculas.indexOf(inputPassword.charAt(i),0) != -1){        
            tieneMayuscula = true;
        }
        if (numeros.indexOf(inputPassword.charAt(i),0) != -1){        
            tieneNumeros = true;
        }
        if (caracteres.indexOf(inputPassword.charAt(i),0) != -1){
            tieneCaracteres = true;
        }
    }

    //Caracter mayuscula
    if(tieneMayuscula == false){
        invalid.style.display = "block";
        invalid.innerHTML = "Debe de haber almenos una mayuscula";
        return false;
    }
    //Caracter numerico
    if(tieneNumeros == false){
        invalid.style.display = "block";
        invalid.innerHTML = "Debe de haber almenos un caracter numerico";
        return false;
    }
    //Caracter especial
    if(tieneCaracteres == false){
        invalid.style.display = "block";
        invalid.innerHTML = "Debe de haber un caracter especial: @¡”#$%&/=’?¡¿:;,.-_+*{][}";
        return false;
    }

    return true;
}


/////////////////ADDCOURSE
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function hideNewCategory(option){
    
    var x = document.getElementById("newCategory");
    var y = document.getElementById("labelNewCategory");

    if(option.value == 0){
        x.style.display = "block";
        x.required = true;
        y.style.display = "block";
        
    }else{
        x.style.display = "none";
        x.required = false;

        y.style.display = "none";

    }
}

function changeTextTypePay(option){
    var x = document.getElementById("labelPrice");
    if(option.value == 0){
        x.innerHTML= 'Precio por curso completo'; 
        
    }else{
        x.innerHTML = "Precio por capitulo";
    }
}

//ADD CHAPTERS
//Agregar lista por cada recurso
$('#customFile2').on('change', function(){
    var lista = document.getElementById("resources");
    var elemento = document.getElementById('customFile2').files[0].name;
    
    var li = document.createElement("li");
    li.textContent = elemento;

    lista.appendChild(li);
});

//Agregar capitulo a la lista
function addChapterToList(){

    var nameChapter = document.getElementById('nameChapter');
    var videoChapter = document.getElementById('videoChapter');
    var cbFree = document.getElementById('cbFree');

    var aux = "<li style='list-style:none'>"+ 
        "<p> "+ nameChapter.value + " </p>" +

        "<input type='file' value ='"+videoChapter.value+"' >" +
        "<p> "+ cbFree.value + " </p>" +
    "</li>"; // Interpreta el HTML

    $("#list-chapters").append(aux);


}

//////////////////BUY COURSE
function hideCardInfo(opcion) {
    var x = document.getElementById("creditCard-box");
    var y = document.getElementById("debitCard-box");
    var z = document.getElementById("paypal-box");
    if (opcion.value == 0) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

    if(opcion.value == 1){
        y.style.display = "block";
    }else{
        y.style.display = "none";
    }

    if(opcion.value == 2){
        z.style.display = "block";
    }else{
        z.style.display = "none";
    }
}