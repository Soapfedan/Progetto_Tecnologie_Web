
 function AutoFill()
    {
        new Ajax.Request(
        "<?=$this->url(array('controller'=>'staff','action'=>'getdata'))?>",
            {
                method:'get',
                parameters: {Immobile: value},
                onSuccess: FillForm
        }
	}

function FillForm(rsp)
{
    var card = eval('(' + rsp.responseText + ')');
    $('Immobili').value = card.items[0].Immobile;
    
}
 