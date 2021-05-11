# Expirados

_Chequeador de enlace masivos_

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Deployment** para conocer como desplegar el proyecto.


### Pre-requisitos 📋

_Necesitas tener instalado Xampp, Wampp, Lampp o algun servidor para php y mysql y configurar una base de datos con la configuracion encontrada en el archivo .env_

# crea un nuevo archivo .env
# o copia el archivo .env.example y cambiale el nombre a .env y configura las configuraciones (DB_DATABASE, DB_USERNAME,...).

_Basicamente esto:_

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expirados
DB_USERNAME=root
DB_PASSWORD=
```

_Necesitas tener instalado Xampp, Wampp, Lampp o algun servidor para php y mysql y configurar una base de datos con la configuracion encontrada en el archivo .env_

```
#Instalar Laravel
#Instalar composer
#Instalar node y npm
```

### Instalación 🔧

_posterior a lo antes dicho se deben de seguir los siguientes pasos:_

_CLona el repositorio:_

```
git clone https://github.com/lajy-enterprise/Expirados.git
```

_Luego de clonar ir al directorio de clonacion:_

```
cd  /directorio_proyecto/
```

_Instala las dependencias de Composer:_

```
composer install
```

_Instala las dependencias de Npm:_

```
npm install
```

_Corre las dependencias de desarrollador:_

```
npm run dev
```

_#Comando para solución a errores de npm:_

```
rm -rf node_modules
rm package-lock.json yarn.lock
npm cache clear --force
npm install
```

_#Solución a error de fsevents_

```
npm i fsevents@latest -f --save-optional
```

_# genere la app encryption key _

```
php artisan key:generate
```

_#Migre la base de datos:_

```
php artisan migrate
```

_Ya puede correr le aplicacion_

## Despliegue 📦

_Para ejecutar la aplicacion debe abrir dos cmd´s o terminales o consola de comandos "Como lo quieras llamar" y correr los siguientes comandos:_

_En la Primera consola_

```
php artisan serve
```

_En la Segunda consola_

```
php artisan queue:work
```

_Inicia LocalHost_


## De aqui en mas lo Edito despues.!




## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - El framework web usado
* [Maven](https://maven.apache.org/) - Manejador de dependencias
* [ROME](https://rometools.github.io/rome/) - Usado para generar RSS

## Contribuyendo 🖇️

Por favor lee el [CONTRIBUTING.md](https://gist.github.com/villanuevand/xxxxxx) para detalles de nuestro código de conducta, y el proceso para enviarnos pull requests.

## Wiki 📖

Puedes encontrar mucho más de cómo utilizar este proyecto en nuestra [Wiki](https://github.com/tu/proyecto/wiki)

## Versionado 📌

Usamos [SemVer](http://semver.org/) para el versionado. Para todas las versiones disponibles, mira los [tags en este repositorio](https://github.com/tu/proyecto/tags).

## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Andrés Villanueva** - *Trabajo Inicial* - [villanuevand](https://github.com/villanuevand)
* **Fulanito Detal** - *Documentación* - [fulanitodetal](#fulanito-de-tal)

También puedes mirar la lista de todos los [contribuyentes](https://github.com/your/project/contributors) quíenes han participado en este proyecto. 

## Licencia 📄

Este proyecto está bajo la Licencia (Tu Licencia) - mira el archivo [LICENSE.md](LICENSE.md) para detalles

## Expresiones de Gratitud 🎁

* Comenta a otros sobre este proyecto 📢
* Invita una cerveza 🍺 o un café ☕ a alguien del equipo. 
* Da las gracias públicamente 🤓.
* etc.



---
⌨️ con ❤️ por [Villanuevand](https://github.com/Villanuevand) 😊