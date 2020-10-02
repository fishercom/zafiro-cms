<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Línea Anónima</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
	<script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
</head>
<body>

@yield('content')

<script language="javascript">
$(document).ready(function(){
	$('.boton').bind('click', function() {
		parent.$.fancybox.close();
	});
});
</script>
</body>
</html>