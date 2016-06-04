function check(){
	
	if($('#Password').val() != $('#Password1').val()){
		$('#Password').addClass('wrong');
	}
	else
		$('#Password').removeClass('wrong');
}
