# ImperioBarber - Sistema Web de Gestión de Citas
 
Aplicación web responsiva para automatizar la gestión de turnos y reservas de la barbería **ImperioBarber**. Reemplaza el agendamiento manual (cuadernos, llamadas y mensajes de WhatsApp) por una plataforma de autogestión disponible 24/7 que evita los cruces de horarios y centraliza la información de los clientes.
 
---
 
## Características principales
 
* **Agendamiento en 3 pasos:** el cliente elige el servicio, el barbero y reserva su turno desde cualquier dispositivo.
* **Control de concurrencia:** transacciones ACID y bloqueo de fila FOR UPDATE para evitar que dos clientes reserven el mismo horario con el mismo barbero.
* **Roles y seguridad:** acceso por roles (**Cliente**, **Barbero** y **Administrador**), contraseñas encriptadas y cierre de sesión por inactividad.
---
 
## Tecnologías
 
* PHP 8.2+ / Laravel 12
* MySQL / MariaDB
* Blade, HTML5, CSS3, JavaScript
* Patrón MVC
---
 
## Requisitos previos
 
* [PHP](https://www.php.net/) >= 8.2
* [Composer](https://getcomposer.org/)
* [Node.js y NPM](https://nodejs.org/)
* [XAMPP](https://www.apachefriends.org/) o Laragon (para MySQL)
* [Git](https://git-scm.com/)
---
 
## Instalación
 
### 1. Clonar el repositorio
 
```bash
git clone https://github.com/earenteria27/ImperioBarber.git
cd ImperioBarber
```
 
### 2. Instalar dependencias
 
```bash
composer install
npm install
npm run build
```
 
### 3. Crear el archivo `.env`
 
```bash
copy .env.example .env
```
Revisa que los datos de la base de datos queden así:
 
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=imperiobarber
DB_USERNAME=root
DB_PASSWORD=
```
 
### 4. Generar la llave de la aplicación
 
```bash
php artisan key:generate
```
 
### 5. Ejecutar las migraciones
 
Enciende **MySQL** en XAMPP y ejecuta:
 
```bash
php artisan migrate
```
 
Si la base de datos `imperiobarber` no existe, Laravel preguntará si quieres crearla: responde **yes**. (También puedes crearla manualmente en `http://localhost/phpmyadmin`).
 
### 6. Cargar los datos iniciales
 
```bash
php artisan db:seed
```
 
### 7. Iniciar el servidor
 
```bash
php artisan serve
```
 
Abre en tu navegador: **http://127.0.0.1:8000**
 
---
 
## Equipo de desarrollo
 
Proyecto de **Tecnología en Sistemas de la Información** — Institución Universitaria Antonio José Camacho (2026):
 
* **Gisela Andrade Murillo** — Product Owner y desarrolladora
* **Ana Yiseth Solarte Ruiz** — Scrum Master y desarrolladora
* **Michelle Dayanna Duque Marín** — Desarrolladora
* **Eduar Andrés Rentería Balverde** — Desarrollador
 
