# Sistema de Gestión de Piezas - La Minucia

## 📋 Descripción del Proyecto

Sistema web para la visualización y gestión de piezas registradas en La Minucia, desarrollado como prueba técnica. La aplicación permite el registro, actualización y consulta de información de piezas organizadas por proyectos y bloques.

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 10 con Eloquent ORM
- **Frontend**: Vue.js 3
- **Base de Datos**: SQLite
- **Integración**: Laravel Inertia.js
- **Autenticación**: Laravel Sanctum/Breeze
- **Estilos**: CSS/Tailwind CSS (según implementación)

## ✨ Características Implementadas

### Requerimientos Básicos (RB) ✅
- [x] Sistema de login con validación de usuario y contraseña
- [x] Redirección automática tras login exitoso
- [x] Formulario principal para registro de piezas
- [x] Carga automática de fecha y hora
- [x] Lista desplegable de proyectos
- [x] Lista desplegable de bloques (anidada por proyecto)
- [x] Selección de piezas con carga automática de peso teórico
- [x] Campo de ingreso de peso real
- [x] Validación numérica del peso real
- [x] Botón de registro para guardar información
- [x] CRUD completo para todas las tablas

### Requerimientos Adicionales (RA) ✅
- [x] Protección de rutas (middleware de autenticación)
- [x] Filtro de piezas por bloque seleccionado
- [x] Mostrar solo piezas en estado "Pendiente"
- [x] Cálculo automático de diferencia de pesos
- [x] Validación del lado del cliente (browser)
- [x] Manejo de errores con preservación de datos del formulario
- [x] Diseño responsivo (móvil y escritorio)
- [x] Reporte de piezas pendientes agrupadas por proyecto
- [x] Reporte gráfico de piezas pendientes vs fabricadas

## 🗄️ Estructura de Base de Datos

### Tablas Implementadas

1. **users** - Usuarios del sistema
2. **proyectos** - Proyectos disponibles
3. **bloques** - Bloques asociados a proyectos
4. **piezas** - Catálogo de piezas
5. **registros_piezas** - Registros de pesaje y estado

### Modificaciones al Esquema Original

- Se agregó campo `estado` en la tabla `piezas` para manejar estados "Pendiente" y "Fabricada"
- Se incluyó campo `diferencia_peso` calculado automáticamente
- Se añadieron índices para optimizar consultas anidadas
- Se implementaron relaciones Eloquent para mejorar el rendimiento

## 🚀 Instalación y Configuración

### Prerrequisitos
- PHP >= 8.1
- Composer
- Node.js >= 16
- NPM o Yarn

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/Danielprogramin/prueba-minucia.git
cd prueba-minucia
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Instalar dependencias de Node.js**
```bash
npm install
```

4. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar base de datos SQLite**
```bash
php -r "file_put_contents('database/database.sqlite', '');"

```

6. **Actualizar .env para SQLite**
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

7. **Ejecutar migraciones y seeders**
```bash
php artisan migrate --seed
```

8. **Compilar assets del frontend**
```bash
npm run dev

```

9. **Iniciar el servidor**
```bash
php artisan serve
```

## 👥 Usuarios de Prueba

| Usuario | Contraseña | 
|---------|------------|
| luis@minucia.com | 0000 |
| gabriel@minucia.com | 1111 | 
| sergio@minucia.com | 2222 | 

## 📱 Funcionalidades

### 1. Sistema de Autenticación
- Login seguro con validación
- Protección de rutas mediante middleware
- Redirección automática según estado de autenticación

### 2. Gestión de Piezas
- Formulario intuitivo con validaciones
- Selección anidada de proyecto → bloque → pieza
- Cálculo automático de diferencias de peso
- Persistencia de datos en caso de error

### 3. Reportes y Consultas
- **Reporte de Pendientes**: Lista de piezas pendientes agrupadas por proyecto
- **Gráfico Comparativo**: Visualización de piezas pendientes vs fabricadas por proyecto

### 4. Diseño Responsivo
- Optimizado para dispositivos móviles
- Interfaz adaptativa para diferentes tamaños de pantalla
- Experiencia de usuario consistente

## 🏗️ Arquitectura del Proyecto

### Backend (Laravel)
```
app/
├── Http/Controllers/
│   ├── AuthController.php
│   ├── PieceController.php
│   ├── ProjectController.php
│   └── ReporteController.php
├── Models/
│   ├── User.php
│   ├── Project.php
│   ├── Block.php
│   ├── Piece.php
│  
└── Http/Requests/
    └── PiezaRequest.php
```

### Frontend (Vue.js)
```
resources/js/
├── Pages/
│   ├── Login.vue
│   ├── Formulario.vue
│   ├── Reporte.vue
│   
└── Pages/
    ├── Dashboard.vue
    
```

## 🔒 Seguridad Implementada

- Autenticación mediante Laravel Sanctum
- Validación CSRF en formularios
- Sanitización de inputs
- Middleware de autenticación en rutas protegidas
- Validación tanto del lado del cliente como del servidor


### Cobertura de Pruebas
- Autenticación de usuarios
- CRUD de todas las entidades
- Validaciones de formularios
- Generación de reportes


## 🐛 Manejo de Errores

- Códigos de error HTTP apropiados
- Mensajes de error descriptivos
- Logging de errores para debugging
- Fallbacks para datos no encontrados

## 📈 Métricas y Rendimiento

- Tiempo de carga optimizado
- Consultas de base de datos eficientes
- Tamaño de bundle JavaScript minimizado
- Imágenes optimizadas para web
