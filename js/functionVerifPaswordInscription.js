
    function isInAlphabet(letter){
        for (let i=1; i<27;i++){
            if (letter==((i + 9).toString(36))) {
                return true ;
            }
        }
        return false;
    }

    function isPasswordTooMuchEasy(passwordIdName){
        let password=document.getElementById(passwordIdName).value;
        let minPassLength=10;
        if (password.length!=0 &&password.length < minPassLength ){           
            return true;
        }
        else{
            for (let letter in password) {
            if (isInAlphabet(password[letter])==false){
                return false;
            }
        }
        }
        return true;
    }