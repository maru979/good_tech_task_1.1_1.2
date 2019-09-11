function tableSort(type) {
    var tbody = document.querySelector("#customTable tbody");
    var rows = [].slice.call(tbody.querySelectorAll("tr"));
    var temp = rows[0].innerHTML;
    for (i = 0; i < rows.length; i++){
        var isSwapped = false;
        for (j = 0; j < rows.length - i - 1; j++){
            if (rows[j].cells[type].innerHTML > rows[j+1].cells[type].innerHTML){
                temp = rows[j].innerHTML;
                rows[j].innerHTML = rows[j + 1].innerHTML;
                rows[j + 1].innerHTML = temp;
                isSwapped = true;
            }
        }
        if (!isSwapped)
            break;
    }
}

function validate(){
    if (validate_username() && validate_email() && validate_mob() && validate_bday() && validate_selectAuto()){
        var customerName = oForm.username.value;
        var email = oForm.email.value;
        var birthDate = oForm.bday.value;
        var carBrand = oForm.selectAuto.value;
        var mobNumber = oForm.mob.value;
        if (mobNumber.length == 12) // +8999...
            mobNumber = mobNumber.slice(1);
        if (mobNumber.length == 11 && mobNumber.charAt(0) == '7') // 7999...
            mobNumber = '8' + mobNumber.slice(1);
        else if (mobNumber.length == 10) // 999...
            mobNumber = '8' + mobNumber;
        else if (mobNumber.length == 7) // 211...
            mobNumber = "8843" + mobNumber;
        var userExist = false;
        $.ajax({
            url:'update_db.php',
            method:'POST',
            data:{
                customerName:customerName,
                email:email,
                mobNumber:mobNumber,
                birthDate:birthDate,
                carBrand:carBrand
            },
            success:function(data){
                if (data == 'exist'){
                    $("h4").html("Такой пользователь уже существует!");
                }
                if (data == 'not_exist'){
                    $("h4").html("Спасибо за заявку!");
                    $("#username").val("");
                    $("#email").val("");
                    $("#mob").val("");
                    $("#bday").val("");
                    $("#selectAuto").val("");
                }
            },
        });
        return true;
    }
    else{
        return false;
    }
}

window.onload = function() {
    oForm = document.forms[0];
    oForm.username.onblur =
    oForm.username.onkeyup =
    function checkUsername(){
        validate_username();
    }

    oForm.email.onblur =
    oForm.email.onkeyup = 
    function checkEmail(){
        validate_email();
    }

    oForm.mob.onblur =
    oForm.mob.onkeyup =
    function checkMob(){
        validate_mob();
    }

    oForm.bday.onblur =
    function checkBday(){
        validate_bday();
    }
    oForm.bday.onkeyup =
    function checkSelectAuto(){
        validate_selectAuto();
    }
}

function validate_username(){
    var valid = true;
    var username_error = document.getElementById('username_error');
    var usernameRegex = /^[А-ЯЁA-Z][а-яёa-z]*([-][А-ЯЁA-Z][а-яёa-z]*)?\s*$/;
    if(!usernameRegex.test(oForm.username.value)){
        oForm.username.style.borderColor = 'red';
        if (oForm.username.value === "")
            username_error.innerHTML = "поле должно быть заполнено";
        else
            username_error.innerHTML = "недопустимая фамилия";
        valid = false;
    }
    else{
        username_error.innerHTML = "";
        oForm.username.style.borderColor = '#b490ca';
    }
    return valid;
}

function validate_email(){
    var valid = true;
    var email_error = document.getElementById('email_error');
    var emailRegex =/\S+@\S+\.\S+/;
    if (oForm.email.value !== ""){
        if(!emailRegex.test(oForm.email.value)){
            oForm.email.style.borderColor = 'red';
            email_error.innerHTML = "недопустимый адрес электронной почты";
            valid = false;
        }
        else{
            email_error.innerHTML = "";
            oForm.email.style.borderColor = '#b490ca';
        }
    }
    else{
        email_error.innerHTML = "";
        oForm.email.style.borderColor = '#b490ca';
    }
    return valid;
}

function validate_mob(){
    var valid = true;
    var mob_error = document.getElementById('mob_error');
    var mobRegex = /^\+?[0-9]{7,11}$/;
    if(!mobRegex.test(oForm.mob.value)){
        oForm.mob.style.borderColor = 'red';
        if (oForm.mob.value === "")
            mob_error.innerHTML = "поле должно быть заполнено";
        else
            mob_error.innerHTML = "недопустимый номер";
        valid = false;
    }
    else{
        mob_error.innerHTML = "";
        oForm.mob.style.borderColor = '#b490ca';
    }
    return valid;
}

function validate_bday(){
    var valid = true;
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    today = yyyy+'-'+mm+'-'+dd;
    var bday_error = document.getElementById('bday_error');
    if (oForm.bday.value === ""){
        bday_error.innerHTML = "поле должно быть заполнено";
        oForm.bday.style.borderColor = 'red';
        valid = false;
    }
    else if (oForm.bday.value > today){
        bday_error.innerHTML = "Не корректная дата";
        oForm.bday.style.borderColor = 'red';
        valid = false; 
    }

    else{
        bday_error.innerHTML = "";
        oForm.bday.style.borderColor = '#b490ca';
    }
    return valid;
}

function validate_selectAuto(){
    var valid = true;
    var selectAuto_error = document.getElementById('selectAuto_error');
    if (oForm.selectAuto.value == ""){
        oForm.selectAuto.style.borderColor = 'red';
        valid = false;
    }
    else{
        selectAuto_error.innerHTML = "";
        oForm.selectAuto.style.borderColor = '#b490ca';
    }
    return valid;
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
today = yyyy+'-'+mm+'-'+dd;
document.getElementById('bday').setAttribute("max", today);