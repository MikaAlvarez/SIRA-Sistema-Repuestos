SIRA — Sistema Integral de Repuestos Automotores

Proyecto: SIRA — Gestión de Repuestos
Autores: Mikaela Alvarez, Nahuel Coronel
Framework: Laravel 12
Repositorio: https://github.com/MikaAlvarez/SIRA-Sistema-Repuestos

* Resumen ejecutivo:

SIRA es una aplicación web para la gestión de repuestos automotores: productos, stock, precios y control de acceso por roles (Administrador / Empleado). El propósito es mejorar el control de inventario y reducir errores por gestión manual.

* Estado del proyecto:

Funcionalidades implementadas: autenticación con Laravel Breeze, CRUD de productos, búsqueda y filtrado, actualización de stock, gestión de precios, y roles Admin/Empleado.

CI: GitHub Actions ejecutando tests y validaciones automáticas.

Tests: Unitarios y de features básicos incluidos y funcionando en CI.

* Requisitos mínimos para ejecutar el proyecto localmente:

PHP 8.2 o superior

Composer

MySQL (o SQLite para pruebas)

Node.js y npm (si se usan assets frontend)

Git

* Instalación (local):

Clonar el repositorio:
git clone https://github.com/MikaAlvarez/SIRA-Sistema-Repuestos.git

cd SIRA-Sistema-Repuestos

Instalar dependencias PHP:
composer install

Copiar el archivo de entorno:
cp .env.example .env

Generar la key de Laravel:
php artisan key:generate

Ejecutar migraciones:
php artisan migrate --seed

Levantar la aplicación:
php artisan serve

* Tests:

Para ejecutar los tests manualmente:
php artisan test

Los tests también se ejecutan automáticamente en GitHub Actions en cada push a la rama main.

* Estructura principal del proyecto:

app/ — controladores, modelos y lógica de negocio

database/migrations/ — definición de tablas

database/seeders/ — datos iniciales

resources/views/ — vistas Blade

tests/ — tests unitarios y de features

.github/workflows/ci.yml — pipeline CI/CD

* Pipeline CI/CD:

El proyecto tiene integrado un pipeline en GitHub Actions que realiza:

Instalación de dependencias PHP

Configuración de entorno de testing con SQLite

Ejecución de migraciones

Ejecución de tests unitarios y de features

Verificación de sintaxis PHP

El historial de ejecuciones puede verse en la pestaña “Actions” del repositorio.

* Roles del sistema:

Administrador:

CRUD completo de productos

Gestión de stock

Actualización de precios

Vistas administrativas

Empleado:

Permisos limitados

Visualización de productos

Acceso restringido a operaciones críticas

* Buenas prácticas aplicadas:

El archivo .env no se versiona

Uso de .env.example para configuración limpia

Validaciones centralizadas con Form Requests

Middleware de roles para seguridad

GitHub Actions configurado para verificar cambios antes del merge

Commits organizados siguiendo buenas prácticas

* Contacto

Mikaela Alvarez
mikaelasolalvarez@gmail.com

Nahuel Coronel
nahuelcoronel21@gmail.com