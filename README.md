#Filemanager para Laravel 5.6
Basado de https://github.com/pqb/filemanager-laravel

##Requiere

"intervention/image": "^2.4"

##Instalación

Edita tu `composer.json`.

	"require": {
		"asanzred/filemanager-laravel": "1.*"
	}

Ejecuta

	composer update

Agrega en tu archivo app.php

	'Asanzred\FilemanagerLaravel\FilemanagerLaravelServiceProvider',

Y en el Facade

	'FilemanagerLaravel'=> 'Asanzred\FilemanagerLaravel\Facades\FilemanagerLaravel',

Copia el Controller, View a la carpeta resources/views/vendor/filemanager-laravel, la carpeta filemanager y tinymce a tu carpeta public, con el siguiente comando:
	
	php artisan vendor:publish

Al final Agrega en routes.php

	Route::group(['prefix' => 'filemanager','middleware' => 'auth'], function() {    
	    Route::get('show', 'FilemanagerLaravelController@getShow');
	    Route::get('connectors', 'FilemanagerLaravelController@getConnectors');
	    Route::post('connectors', 'FilemanagerLaravelController@postConnectors');
	});


Para que carge tinymce con el plugin filemanager agrega:

```
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce_editor.js"></script>
<script type="text/javascript">
editor_config.selector = "textarea";
editor_config.path_absolute = "http://laravel-filemanager.example.com/";
tinymce.init(editor_config);
</script>
```

##Si deseas poner en una sub carpeta
Ejemplo http://localhost/admin/filemanager/

Modifica tu routes.php
```
Route::group(array('middleware' => 'auth'), function(){    
    Route::get('admin/filemanager/show', 'FilemanagerLaravelController@getShow');
    Route::get('admin/filemanager/connectors', 'FilemanagerLaravelController@getConnectors');
    Route::post('admin/filemanager/connectors', 'FilemanagerLaravelController@postConnectors');
});
```
Modifica tu controller
```
// app/Http/Controllers/FilemanagerLaravelController.php
public function getConnectors()
	{
		$extraConfig = array('dir_filemanager'=>'/admin');
		$f = FilemanagerLaravel::Filemanager($extraConfig);
		$f->connector_url = url('/').'/admin/filemanager/connectors';
		$f->run();
	}
	public function postConnectors()
	{
		$extraConfig = array('dir_filemanager'=>'/admin');
		$f = FilemanagerLaravel::Filemanager($extraConfig);
		$f->connector_url = url('/').'/admin/filemanager/connectors';
		$f->run();
	}
```

Modifica todos los enlaces agregando el nombre de tu carpeta
```	
// resources/views/vendor/filemanager-laravel/filemanager/index.blade.php
<link rel="stylesheet" type="text/css" href="{{ url('') }}/admin/filemanager/styles/filemanager.css" />
```

Cambia la url absoluta:
```
<script type="text/javascript">
editor_config.selector = "textarea";
editor_config.path_absolute = "http://laravel-filemanager.example.com/admin/";
tinymce.init(editor_config);
</script>
```


