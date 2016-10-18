$(document).ready(function(){
	$('#datepicker').datepicker({
		dateFormat: "dd/mm/yy",
		altFormat: "yy-mm-dd",
		altField: '#altFormat'
	});
    $('#send').click(function(){
        $('#datepicker').datepicker($.datepicker.regional['fr'], 'option', 'dateFormat', 'dd/mm/yy');
    });
});