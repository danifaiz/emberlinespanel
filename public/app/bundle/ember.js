$(document).ready(function() {
    

    // select2
    $('.m-select2').select2({
        placeholder: "Select a state",
    });
    $('.m-select2').on('select2:change', function(){
        validator.element($(this)); // validate element
    });
    });
