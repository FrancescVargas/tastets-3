# Tastets

## Descripción del programa

Esta aplicación se hizo a petición de la UPC de Vilanova para controlar los Tastets (clases de demostración solicitadas por los colegios para potenciales alumnos de la universidad). 
En la parte pública se visualiza la lista de Tastets disponibles, y clicando en uno de ellos se ven los detalles del mismo, con un formulario de solicitud que el colegio rellena y envía en caso de que esté interesado.

En la parte privada (en esta versión si pones usuario "A" y cualquier password entras como administrador) cada usuario (entrando con usuario "B" y el DNI) se pueden dar de alta los Tastets, editarlos y borrarlos. También se pueden ver las solicitudes para cada uno de ellos y una vez realizada la clase de demostración darla de alta como tal con la fecha de realización de la misma. 
Una vez dado de alta el "Tastet-fet" se pueden almacenar en la base de datos el DNI, nombre y email de cada uno de los estudiantes asistentes, además del centro del que proceden, de forma que se pueda tener un control de la utilidad de estos tastets a la hora de atraer a los alumnos a las carreras de la universidad.

## Creadores

Francesc Vargas

## Requisitos

- Nosotros utilizamos el **Xampp** como emulador de servidor para poder ejecutar el programa.
- Instalar **[composer](https://getcomposer.org/)**.
- Ahora toca instalar lo necesario para que funcione bien (PHP-Slim y PHP-view). Una vez realizado el clonado a través de _GIT_, deberás acceder a la carpeta "_tastets-3_" a través de la interfaz de comandos y ejecutar el comando ***composer install***.
- Lleva un archivo llamado ***instalacion.php*** que sirve para crear la base de datos y añadirle algunos registros con los que trabajar. No tiene dado de alta ningún tastet, por lo que habrá que crear uno.
