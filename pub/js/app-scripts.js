$(document).ready(function() {    

	// $('.back').click(function(){
 //      $('.nav-tabs > .active').prev('li').find('a').trigger('click', [1]);
 //    });

 //    $('#tabs-not-allowed .nav li a').click(function(e, enable_click_on_tab) {
 //        e.preventDefault();
 //        if (!enable_click_on_tab) {return false;}
 //    });

    $('#tabs-not-allowed .nav li a').click(function(e, enable_click_on_tab) {
        e.preventDefault();
        if (!enable_click_on_tab) {return false;}
    });

    // ##############################################
    $(".numdec").on("keypress keyup",function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(".numeric_only").on("keypress keyup",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('input.numsep').on("keypress keyup",function (event) {
        if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
        }

        $(this).val(function(index, value) {
            var x = value.replace(/,/g,'');
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        });
    });

    $('input.numdec2').on("keypress keyup",function (event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
        var input = $(this).val();
        if ((input.indexOf('.') != -1) && (input.substring(input.indexOf('.')).length > 2)) {
            event.preventDefault();
        }
    });
    
});