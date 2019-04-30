function ValidateEl( elemVar, req ){
    let errObj = {valid: false};
    elemVar.classList.remove("is-valid", "is-invalid");

    if(elemVar.type == 'number'){
        if(elemVar.validity.badInput){
            elemVar.classList.add("is-invalid");
            errObj.reason = "badInput";
            return errObj;
        }
    }

    if(!elemVar.value){
        if(req){
            elemVar.classList.add("is-invalid");
        }

        errObj.reason = "empty";
        return errObj;
    }

    if(elemVar.validity.valid){
        elemVar.classList.add("is-valid");
        errObj.valid = true;
    }else{
        elemVar.classList.add("is-invalid");
        errObj.reason = "invalid";
    }

    return errObj;
}
