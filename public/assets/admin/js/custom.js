$(document).ready(function(){
    //Flat red color scheme for iCheck
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});

	$('.mod_delete').on('click', function(e) {
		e.preventDefault();
		var el = $(this).parent();
		var title = el.attr('data-title');
		var msg = el.attr('data-message');
		var id = el.attr('data-form');

		$('#mod_delete')
		.find('.modal-body').html(msg)
		.end().find('.modal-title').html(title)
		.end().modal('show');

		$('#mod_delete').find('.submit').attr('data-form', id);
	});

	$('#mod_delete').on('click', '.submit', function(e) {
	    var id = $(this).attr('data-form');
	    $(id).submit();
	});

    $("#frm_import").on("submit", function(e){
        e.preventDefault();
        var submit = $('#frm_import button[type=submit]');
        var label = submit.html();

        submit.html('<i class="fa fa-refresh fa-spin fa-fw"></i> Cargando ...');
        var formData = new FormData(document.getElementById("frm_import"));
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(data){

        	$('#frm_import').append('<div class="alert alert-warning"><strong>Carga Exitosa!</strong> Los datos se han importado correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			submit.html(label);
        	console.log(data);
        }).error(function(){
			submit.html(label);        	
        });
    });

	$('#importer').on('hidden.bs.modal', function () {
		location.reload();
	})

});

$(document).ajaxError(function( event, request, settings, exception) {
  alert('Ha ocurrido un error interno en la aplicación. Por favor, inténtelo mas tarde.');
  console.log("url: " + settings.url);
  console.log("error: " + exception);
  console.log("data: " + request.responseText);
});
