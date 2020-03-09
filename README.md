# Aplicacion de prueba con la api de spotify

Para instalar ejecutar

git clone https://github.com/salojc2006/aivo_test.git
cd aivo_test
composer install

Y arrancamos el servidor con el builtin de php.
php -S localhost:8080 -t public public/index.php

Yo dejé las credenciales para la api de Spotify en una clase de configs que est en src\App\Config.php, pueden cambiarla desde ahí o utilizar las mismas.
Podría utilizar la configuración del framework pero para no acoplar tanto la aplicación lo puse ahí.

Los archivos creados por mí están en src\Spotify\.. y modifqué el app/routes.php

En el código hay algunos comentarios, en inglés (sepan disculpar lo pésimo que soy en ello)
