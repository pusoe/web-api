
{{ $name }}


<html>

<body>


	<a href={{ route("product.show", ['name' => "keyboard"]) }}>Submit</a>
	<a href={{ route("product.show", ['name' => "laptop"]) }}>Submit</a>
	<a href={{ route("product.show", ['name' => "desktop"]) }}>Submit</a>

	<a href="{{ url('/admin/test/monitor') }}"> Product </a>



</body>
</html>





