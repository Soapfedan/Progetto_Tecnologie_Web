$(document).ready(function(){
                $(':input').change( function(event){
                    var element = $(this);
                    element.removeClass('has-error');
                    switch (element.attr('id')) {
                        case 'Username':
                            var pattern = /^([A-Za-z0-9_\-\.\@])+$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                        case 'Password':
                            if (element.val().length < 5) {
                                element.addClass('has-error');
                            }
                            break;
                       case 'Nome':
                            var pattern = /^([A-Za-z])+$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                       case 'Cognome':
                            var pattern = /^([A-Za-z])+$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                            
                      case 'Data_di_nascita':
                            var pattern = /^\d{4}+\d{2}+\d{2}$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                        case 'Citta':
                            var pattern = /^([A-Za-z])+$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                       
                       case 'Codice_fiscale':
                            var pattern = /^([A-Za-z0-9])+$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                     
                        case 'Email':
                            var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,6})$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                        case 'Coordinate':
                        	var pattern = /^\"(\d)+(\,\d+)+\"$/
                        	if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                        case 'Shape':
                        	var pattern = /^\"(poly|circle|rect)\"$/
                            if (!pattern.test(element.val())) {
                                element.addClass('has-error');
                            }
                            break;
                    };
                });

                $('form').on('submit', function(event){
                    $(':input').trigger('change');
                    if ($(':input').filter('[class*=has-error]').size() != 0) {
                        return false;
                    };
                });
            });