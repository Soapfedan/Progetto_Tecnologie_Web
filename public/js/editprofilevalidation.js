$(document).ready(function(){

    $('input').blur(function() {
    var pass = $('#Password1').val();
    var repass = $('#Password').val();
    if(($('#Password1').val().length == 0) || ($('#Password').val().length == 0)){
        $('#Password1').addClass('has-error');
    }
    else if (pass != repass) {
        $('#Password1').addClass('has-error');
        $('#Password').addClass('has-error');
    }
    else {
        $('#Password1').removeClass().addClass('has-success');
        $('#Password').removeClass().addClass('has-success');
    }
});
	
	$('#formprofile').submit(function(){
        	
        	if ($('#Password').hasClass('has-error')){
 					return false;
           }
        });
	
});
 /*$(document).ready(function(){

        $('#Password').on('change', function(event){
        	
        	checkpass();
            
        });
        
        $('#formprofile').on('submit', function(event){
        	checkpass();
        	if ($('#Password').hasClass("wrong")){
           		 document.writeln("DIOMERDA");
           		 return false;
           }
        });
   });
   
   
   function checkpass(){
   	
   	if ($("#Password").html($("#Password").val()) != $("#Password1").html($("#Password1").val())){
                
				$("#Password").parent().parent().find('.errors').html(' ');
				$("#Password").parent().parent().find('.errors').html($("#Password").parent().parent().find('.errors').val('Hai inserito due password differenti'));
				$("#Password").addClass("wrong");
           }
            else{
                $("#Password").removeClass("wrong");

           }
   	
   	
   }
        /*
        $(:input).filter('[class *= check]').on('change', function(event){
            if $(ps1).attr("value") != $(ps2).attr("value")
        })
        
 
        $('form').on('submit', function(event){
            $(':input').trigger('change');
            if ($(':input').filter('[class*=_error]').size() != 0) {
                return false;
            };
        });
    });*/
   
