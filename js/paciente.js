function SetChecked(value) {
    if(value == 2)
        $("#sl_stransporte").prop('disabled', 'disabled');
    else
        $("#sl_stransporte").removeAttr('disabled');
}
