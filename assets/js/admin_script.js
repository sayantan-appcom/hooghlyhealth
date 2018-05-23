function onlyNumbers(evt)
      {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if ( ((charCode >= 48) && (charCode <= 57)) || charCode==8 || charCode==32 )
            return true;
            return false;
      }

function onlyLetters(evt)
      {
          var charCode = (evt.which) ? evt.which : event.keyCode;
         if ( ((charCode >= 65) && (charCode <= 90)) || ((charCode >= 97) && (charCode <= 122)) || charCode==8 || charCode==32 )
            return true;
            return false;
      }  

function onlyLicense(evt)
      {
          var charCode = (evt.which) ? evt.which : event.keyCode;
         if ( ((charCode >= 65) && (charCode <= 90)) || ((charCode >= 48) && (charCode <= 57)) || ((charCode >= 97) && (charCode <= 122)) || charCode==8 || charCode==32 || charCode==45 || charCode==47 )
            return true;
            return false;
      }  

function IsValidEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }  

 