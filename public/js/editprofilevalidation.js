$(function(){
	
        var ps1 = '#Password1';
        var ps2 = '#Password';
        
        $('#Password').on('change', function(event){
        	var e = $(this);
            if (e.val() != $('#Password1').val()){
                e.addClass("wrong");
                document.writeln("TOP");
           }
            else{
                e.removeClass("wrong");
                document.writeln("DOWN");
           }
        });
        
        $('form').on('submit', function(event){
            if ($('#Password').hasClass("wrong")){
            	document.writeln("DIOMERDA");
                return false;
           }
        });
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