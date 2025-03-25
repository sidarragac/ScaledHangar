# ScaledHangar - Proyecto Laravel

## Requisitos previos

- **XAMPP**: Versión 8.1 o superior (https://www.apachefriends.org/es/download.html)
- **Composer**: Última versión estable (https://getcomposer.org/)
- **Node.js**: Versión 16 o superior (https://nodejs.org/) (opcional para frontend)
- **Git**: (Opcional para control de versiones)

---

## Configuración inicial

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/sidarragac/ScaledHangar.git scaledhangar
   cd scaledhangar
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   npm install  # Solo si usa frontend con Node
   ```

3. **Configurar entorno**:
   ```bash
   copy .env.example .env
   ```

4. **Configurar base de datos**:
   - Iniciar XAMPP y activar Apache y MySQL
   - Crear la base de datos `scaled_db` en phpMyAdmin

---

## Configuración del archivo .env

Editar el archivo `.env` con estos valores esenciales:

```env
APP_NAME=ScaledHangar
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scaled_db
DB_USERNAME=root
DB_PASSWORD=
```

## Comandos de instalación

Ejecutar en orden:

```bash
php artisan key:generate
php artisan storage:link  # Si usa almacenamiento local
php artisan migrate --seed
php artisan serve
```

---


## Acceso al sistema

```bash
php artisan serve
```

- **URL local**: http://127.0.0.1:8000

---

   
