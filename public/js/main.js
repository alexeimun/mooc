function Alert(message, buttons, type, title)
{
    if (!type)
    {
        type = BootstrapDialog.TYPE_SUCCESS;
    }
    if (!title || title === true)
    {
        title = '<span style="color: #ffffff;font-size: 20pt;"class="ion ion-checkmark-round"></span>&nbsp;&nbsp; <span style="font-size: 18pt;">Bien hecho...</span>'
    }

    BootstrapDialog.show({
        title: title,
        message: message,
        draggable: true,
        type: type,
        buttons: buttons
    });
}
function clearFields()
{
    $('input, textarea').val('');
}

function killMessage()
{
    $('#jmsg').next('br').remove().end().remove();
}

function Message(Msg, Type, Element, Time)
{
    if (!Element)
    {
        Element = 'form.form-horizontal';
    }

    if (!Msg)
    {
        Msg = 'El formulario contiene los siguientes errores...';
    }
    if (!Time && Time != 0)
    {
        Time = 500;
    }

    var icon = 'close-circled';
    switch (Type)
    {
        case 'danger':
            icon = 'close-circled';
            break;
        case 'warning':
            icon = 'close-circled';
            break;
        case 'info':
            icon = 'checkmark-round';
            break;
        case 'success':
            icon = 'checkmark-round';
            break;
        default :
            Type = 'danger';
            break;
    }
    $('#jmsg').next('br').remove().end().remove();
    $(Element).prepend($('<div id="jmsg"  style="font-size: 12pt;" class="callout callout-' + Type + ' no-margin">' +
        '<span style="cursor:pointer" class="ion ion-' + icon + '"></span>&nbsp;' + Msg + '</div><br>')).hide().show(Time);

    setTimeout(function ()
    {
        killMessage();
    }, Time+5000)
}