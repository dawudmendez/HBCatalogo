$(document).ready(function(){

    $("#pag_prod_cant_div").hide();

    function ceroProd() {
        $("#prod_2_row").hide();
        $("#prod_4_row").hide();
    }

    function dosProd() {
        $("#prod_2_row").show();
        $("#prod_4_row").hide();
    }

    function cuatroProd() {
        $("#prod_2_row").show();
        $("#prod_4_row").show();
    }

    $("#pag_siguiente").click(function(){                    
        
        if($("#pag_tipo_radio_0").is(':checked')) {
            ceroProd();
        }
        else if($("#pag_tipo_radio_2").is(':checked')) {
            dosProd();
        }
        else if($("#pag_tipo_radio_4").is(':checked')) {
            cuatroProd();
        }
        
        $("#collapseProd").collapse('toggle');
        $("#headingOne").removeClass("text-white bg-primary");
        $("#headingTwo").addClass("text-white bg-primary");  
                       
    });

    $("#prod_atras").click(function(){
        $("#collapsePag").collapse('toggle');
        $("#headingTwo").removeClass("text-white bg-primary");
        $("#headingOne").addClass("text-white bg-primary");
    });

}); 