  var errorMessage = {
    'name'        : 'Имя должно быть заполненно, и не должно содержать цыфр!',
    'email'       : 'Email адрес введен некорректно, пожалуйста, введите корректно почтовый адрес.',
    'address'     : 'Укажите корретный адрес.',
    'age'         : 'Поле с возрастом не должно содержать букв, и быть пустым',
    'phone'       : 'Необходимо ввести номер телефона',
    'message'     : 'Опишите свою проблему.'
  }

  function checkFields(event, thisLink){
    var form, inputDataCount;

    event.preventDefault();

    var dataForm = {};

    form = $(thisLink).closest('form')[0];

    inputDataCount = $('input, textarea', $(form) ).length;

    for(var i=0; i < inputDataCount; i++){
        
        input = $('input, textarea', $(form))[i];

        if(!validationData(input)){
          return false;
        }
    }

    form.submit();
    return true;
  }

  function validationData(inputData){

    var validateAttrName = $(inputData).attr('name');

    var dataVal = $(inputData).val();

    var validate = {
      
      name    : function (){
        if( (dataVal.length < 1) || issetNumber(dataVal) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      },

      email   : function (){
        if( validateRegEx( /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/, dataVal) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      },

      age : function (){
        if( (dataVal.length < 1) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      },

      message : function (){
        if( (dataVal.length < 1) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      }
    };

    if( validate.hasOwnProperty(validateAttrName) ){
      return validate[validateAttrName]();
    }

    return true;
  }

  function issetNumber(text){
    for(i=0; i<text.length; i++){
      if(!isNaN(text[i]) && (text[i] !== " ") ) {
        return true;
      }
    }
    return false;
  }

  function validateRegEx(regex, Str){
    if( !regex.test(Str) ){
      return true;
    }
    return false;
  }