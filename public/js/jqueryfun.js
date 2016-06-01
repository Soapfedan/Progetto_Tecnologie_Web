function fetchajax(actionUrl) {
		
	function populate(data){

    var select = $("#immobili");
    $(select).find('option').not(':first').remove();
    $(data).find('Immobile').each(function(){
    										 $(select).append('<option>' + $(this).text() + '</option>');
                							});
    }      


		
	$.ajax({
		type : 'POST',
		url : actionUrl,
		data : {'Immobile': $("#immobili").val(),'isAjax':true},
		dataType : 'json',
		success : populate(data)
	});
}
