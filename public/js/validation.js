function check(){
	
	docuemnt.writeln('aaa');
	if($('#Password').val() != $('#Password1').val()){
		$('#Password').addClass('wrong');
	}
	else
		$('#Password').removeClass('wrong');
	docuemnt.writeln('bbb');
}
