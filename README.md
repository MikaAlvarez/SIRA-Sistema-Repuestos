# 🚗 SIRA - Sistema Integral de Repuestos Automotores

> Sistema web de gestión de inventario desarrollado para **Italfiat Repuestos** - Formosa, Argentina

## Descripción del Proyecto

SIRA es un sistema web diseñado para modernizar la gestión de inventario de repuestos automotores en Italfiat Repuestos, una empresa familiar con más de 15 años de trayectoria en Formosa.

### Problema que resuelve:
- ❌ Control manual de inventario propenso a errores
- ❌ Demoras en consultas de stock y precios
- ❌ Falta de trazabilidad en movimientos de productos
- ❌ Acceso no controlado a la información crítica

### Solución implementada:
- ✅ Sistema web con control de roles (Admin/Empleado)
- ✅ Gestión CRUD completa de productos y categorías
- ✅ Registro de movimientos de stock en tiempo real
- ✅ Consultas rápidas y búsquedas eficientes
- ✅ Interfaz responsive y fácil de usar

---

## Stack Tecnológico

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| **Laravel** | 12.x | Framework backend (MVC) |
| **PHP** | 8.2+ | Lenguaje del servidor |
| **MySQL** | 8.0 | Base de datos relacional |
| **Blade** | - | Motor de plantillas |
| **Tailwind CSS** | 3.x | Framework CSS |
| **Alpine.js** | 3.x | Interactividad frontend |
| **Laravel Breeze** | - | Autenticación y autorización |

---

## Arquitectura del Sistema

### Patrón MVC (Model-View-Controller)

```
├── app/
│   ├── Http/Controllers/    # Lógica de negocio
│   ├── Models/              # Modelos Eloquent
│   └── Middleware/          # Autenticación y autorización
├── database/
│   ├── migrations/          # Estructura de BD
│   └── seeders/             # Datos de prueba
├── resources/
│   └── views/               # Vistas Blade
└── routes/
    └── web.php              # Rutas de la aplicación
```

### Modelos principales:
- **User**: Usuarios con roles (admin/empleado)
- **Producto**: Repuestos automotores
- **Categoria**: Clasificación de productos
- **Movimiento**: Entradas/salidas de stock

## Requisitos Previos

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 18 (para assets)
- Git

## Instalación y Configuración

### 1. Clonar el repositorio

```bash
git clone https://github.com/nahuellc1/tifsira.git
cd tifsira
```

### 2. Instalar dependencias

```bash
# Dependencias de PHP
composer install

# Dependencias de Node.js
npm install
```

### 3. Configurar variables de entorno

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# Generar key de aplicación
php artisan key:generate
```

### 4. Configurar base de datos

Edita el archivo `.env` con tus credenciales:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sira_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Ejecutar migraciones y seeders

```bash
# Crear tablas
php artisan migrate

# Cargar datos de prueba
php artisan db:seed
```

### 6. Compilar assets

```bash
npm run dev
```

### 7. Iniciar servidor de desarrollo

```bash
php artisan serve
```

Accede a la aplicación en: **http://localhost:8000**

---

## 👥 Usuarios de Prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | admin@italfiat.com | password |
| Empleado | empleado@italfiat.com | password |

---

## 📱 Funcionalidades Principales

### Para Administradores:
- ➕ Crear, editar y eliminar productos
- 📦 Gestionar categorías de repuestos
- 📊 Registrar movimientos de stock (entradas/salidas)
- 💰 Actualizar precios de productos
- 👥 Control total del sistema

### Para Empleados:
- 🔍 Consultar catálogo de productos
- 📋 Ver stock y precios actualizados
- 🔎 Buscar productos por código o nombre
- 📂 Filtrar por categorías

---

## 🎯 Metodología de Desarrollo

### Framework Ágil: **Scrum**

- **Sprints**: 4 sprints de 2 semanas
- **Equipo**: 2 desarrolladores
- **Duración total**: 190 horas

### Roles del equipo:
- **Mikaela Alvarez**:  Backend- Frontend (vistas, diseño, validaciones)
- **Nahuel Coronel**: Backend- Frontend (controladores, BD, autenticación)


## 🔒 Seguridad

- 🔐 Contraseñas encriptadas con bcrypt
- 🛡️ Middleware de autorización por roles
- 🚫 Protección CSRF en formularios
- ✅ Validación de datos en servidor
- 🔑 Gestión segura de sesiones con Laravel Breeze

---

## 📊 Base de Datos

### Modelo Relacional:

```
users (id, name, email, password, role)
  ↓
productos (id, codigo, nombre, descripcion, precio, stock, categoria_id)
  ↓
categorias (id, nombre, descripcion)
  ↓
movimientos (id, producto_id, user_id, tipo, cantidad, fecha)
```
### Relaciones:
- `productos → categorias` (N:1)
- `productos → movimientos` (1:N)
- `users → movimientos` (1:N)

---
## 🧪 Testing

### Ejecutar pruebas:

```bash
php artisan test
```

_(Nota: Las pruebas se implementarán en futuras versiones)_

---
## 📈 Roadmap - Funcionalidades Futuras

- [ ] Módulo de ventas y facturación
- [ ] Gestión de clientes y cuentas corrientes
- [ ] Sistema de alertas de stock mínimo
- [ ] Reportes estadísticos avanzados
- [ ] Exportación de datos a Excel/PDF
- [ ] API REST para integraciones
- [ ] Código de barras para productos

---

## 👨‍💻 Autores

| Alumno | Legajo | Responsabilidad |
|--------|--------|-----------------|
| **Mikaela Alvarez** | 29130 | Frontend & UX |
| **Nahuel Coronel** | 29150 | Backend & BD |

**Materia**: Metodología de Sistemas II  
**Institución**: UTN - Tecnicatura Universitaria en Programación  
**Año**: 2025

---

## 📄 Licencia

Este proyecto fue desarrollado con fines académicos para la empresa **Italfiat Repuestos** como Trabajo Final Integrador (TFI).

---

## 🙏 Agradecimientos

- **Wenceslao Coronel** - Tutor en Italfiat Repuestos
- **UTN Formosa** - Tecnicatura Universitaria en Programación
- Comunidad de Laravel Argentina

---

## 📞 Contacto

- 📧 Email: nahuelcoronel21@gmail.com - mikaelasolalvarez@gmail.com
- 🏢 Empresa: Italfiat Repuestos - Formosa, Argentina
