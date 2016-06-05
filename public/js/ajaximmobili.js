function AutoFill()
    {
        $.ajax({
        type : 'POST',
        url : "<?php $this->url(array('controller'=>'staff','action'=>'getdata'))?>",
        data : {'Immobile': $("#immobili").val(),'isAjax':true},
        dataType : 'json',
        success : populate()
    });
       
    }

function populate(data){

    var select = $("#immobili");
    $(select).find('option').not(':first').remove();
    $(data).find('Immobile').each(function(){
                                             $(select).append('<option>' + $(this).text() + '</option>');
                                            });
    }   