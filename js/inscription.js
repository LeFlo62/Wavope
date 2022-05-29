var pwdErrspan1 =   document.getElementById('span1');
var pwdErrspan2 =   document.getElementById('span2');
document.getElementById("password").onblur =  function(){
    if(isPasswordTooMuchEasy('password')){
        pwdErrspan1.innerHTML = "&nbsp;&nbsp;&nbsp;Votre mot de passe est trop facile !";
    }
    else{
        document.getElementById("passwordCheck").onblur =  function(){
            var pwd = document.getElementById("password").value;
            var confpwd = document.getElementById("passwordCheck").value;
            if(pwd!=confpwd){
                pwdErrspan2.innerHTML = "&nbsp;&nbsp;&nbsp;Les mots de passes ne sont pas identiques !";
            }
        }
    }

};

document.getElementById("password").onfocus =  function(){
    pwdErrspan1.innerHTML ="";
};
document.getElementById("passwordCheck").onfocus =  function(){
    pwdErrspan2.innerHTML ="";
};

$('input:not("[type=submit]")').focusout(function(){
    if($(this).val().length == 0){
        $(this).addClass('empty-field');
    } else if($(this).hasClass('empty-field')) {
        $(this).removeClass('empty-field');
    }
});