/*==================================
=            Data table            =
==================================*/

$(function () {
    $('.tabla').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "language": {
    		"sProcessing": 	"Procesando...",
    		"sLengthMenu": 	"Mostrar _MENU_ registros",
    		"sZeroRecords": "No se encontraron resultados",
    		"sEmptyTable": 	"Ningún dato disponible en esta tabla",
    		"sInfo": 		"Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    		"sInfoEmpty": 	"Mostrando registros del 0 al 0 de un total de 0",
    		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    		"sInfoPostFix": "",
    		"sSearch": 		"Buscar:",
    		"sUrl": 		"",
    		"sInfoThousands": ",",
    		"sLoadingRecords": "Cargando...",
    		"oPaginate": {
    			"sFirst": 	"Primero",
    			"sLast": 	"Último",
    			"sNext": 	"Siguiente",
    			"sPrevious": "Anterior"
    		},
    		"oAria": {
    			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
    			"sSortDescending": ": Activar para ordenar la columna de manera descendente",
    		}
    	}
    });
    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    var $_GET = {};

  document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
      function decode(s) {
          return decodeURIComponent(s.split("+").join(" "));
      }

      $_GET[decode(arguments[1])] = decode(arguments[2]);
  });
  });

//iCheck for checkbox and radio inputs
$(function () {
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  });
    

//Flat red color scheme for iCheck

  $(function () {
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  });
  $(function () {
    // Data masks
      //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
  });

/*==============================================
=            GUARDAR REGISTRO            =
==============================================*/
$(function(){
  $(document).on('click', '.btnRegistrar' ,function(){
    var placa = $('.plate').val();
    var datos = new FormData();
    datos.append("placa", placa);
    $.ajax({
      url:"ajax/tickets/crear",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
        console.log('ok')
        $('.plate').val("");
      }
    })
  });
});
/*==============================================
=            GUARDAR REGISTRO            =
==============================================*/
$(function(){
  $(document).on('click', '.btnConsultar' ,function(){
    var placa = $('.plate').val();
    var datos = new FormData();
    datos.append("placa", placa);
    $.ajax({
      url:"ajax/tickets/buscar",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
        if (answer != null && answer != "") {
          answer=JSON.parse(answer);
          console.log(answer['created_at']);
          swal({
            type: "info",
            title: "El ultimo registo para la placa "+placa.toUpperCase()+" fue: \nEl día: "+moment(answer['created_at']).format("DD/MM/YYYY")+"\nA las: "+moment.utc(answer['created_at']).format("HH:mm"),
            // title: answer,
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            });
          $('.plate').val("");
        }else{
          swal({
            type: "error",
            title: "No se encuentran registros para la placa"+placa.toUpperCase(),
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: true
            });

          $('.plate').val("");
        }
      }
    })
  });
});