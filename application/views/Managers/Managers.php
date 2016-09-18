<?php
    /**
     * @var $this CI_Loader|App
     */
    $id = $this->session->userdata('ID_MANAGER');
    $this->Header(['assets' => ['datatables', 'dialogs']], 'main');

    Component::Table(['columns' => ['', 'Nombre', 'Correo', 'Último inicio de sesión', 'Feha de ingreso',], 'tableTitle' => 'Managers', 'tableName' => 'manager', 'showRowCondition' => true,
        'controller' => 'managers', 'autoNumeric' => true, 'id' => 'ID_MANAGER', 'dataProvider' => $this->managers_model->TraeManagers(),
        'actions' => ['d,u' => '$record[$id] !=' . $id . ' && $record[$id] !=1', 'static' => 'v'],
        'fields' => ['PHOTO' => ['type' => 'img', 'path' => site_url('public/photos')], 'MANAGER_NAME', 'MANAGER_EMAIL', 'LAST_LOG_IN' => 'moment', 'REG_DATE' => 'date']]);

    echo $this->Footer();
?>
<script type='text/javascript'>
    $(function ()
    {
        $('#tabla').dataTable({
            'language': {
                'sProcessing': 'Procesando...',
                'sLengthMenu': 'Mostrar _MENU_ registros',
                'sZeroRecords': 'No se encontraron resultados',
                'sEmptyTable': 'Ningún dato disponible en esta tabla',
                'sInfo': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix': '',
                'sSearch': 'Buscar:',
                'sUrl': '',
                'sInfoThousands': ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst': 'Primero',
                    'sLast': 'Útimo',
                    'sNext': 'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            }
        });

        $('body').on('click', 'a[data-id]', function ()
        {
            var id = $(this).data('id');
            Alert('¿Está seguro que desea eliminar este registro?', [{
                    label: 'Aceptar',
                    cssClass: 'btn-danger',
                    action: function ()
                    {
                        if (id != 1)
                        {
                            $.ajax({
                                type: 'post', url: 'managers/eliminarmanager', data: {Id: id},
                                success: function ()
                                {
                                    location.href = '';
                                },
                                error: function (data)
                                {
                                    if (data.status == 500)
                                    {
                                        $(".bootstrap-dialog-message").html('<br> <span style="color: #8c4646"><b>&nbsp;No se puede eliminar este registro! </b>Asegurese de que no esté siendo utilizado en otros módulos del sistema.</span>')
                                    }
                                }
                            });
                        }
                        else
                        {
                            $(".bootstrap-dialog-message").html("<b> <i class='fa fa-exclamation-triangle'></i> No se puede eliminar el manager raíz!</b>");
                        }
                    }
                },
                    {
                        label: 'Cancelar',
                        action: function (dialogItself)
                        {
                            dialogItself.close();
                        }
                    }]
                , BootstrapDialog.TYPE_DANGER,
                '<span class=\"fa fa-trash\" style=\"font-size: 20pt;font-weight: bold; color: white;\"></span>&nbsp;&nbsp;&nbsp; <span  style=\"font-size: 18pt;\">Atención!</span>');
        });
    });
</script>
