function Validator(param) {
    
    this.param = (param.toString()).trim();
    this.check_input_length = check_input_length(this.param);
    this.validate_input = validate_input(this.param);
}

function check_input_length(param) {
        
    if (param.length < 1) {
        return false;
    }
    
    return true;
}

function validate_input(param) {
    
    var wc = /^[\w ]+$/;
    
    if(!wc.test(param)){
        return false;    
    }
    
    return true;
}
