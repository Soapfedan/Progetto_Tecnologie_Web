/**
 * @author Federico-PC
 */
$(function()
{
        var imms='<?php echo $this->imms ?>';
     $('#immobili').find('option').remove();
                $(xml).find('provincia').each(function(){
                    $('#immobili').append('<option>' + $(this).text() + '</option>');
                });
    $("#immobili").on('blur', function(event) {
    var formElementId = $(this).attr('id');
    
    });
});