# Estado actual del proyecto Workshop

Fecha del análisis: 4 de agosto de 2026.

## Resumen ejecutivo

Workshop es una aplicación web interna para gestionar el taller de Prometeo. Su dominio incluye fabricantes, repuestos, pedidos o albaranes y sus relaciones con usuarios, locales, bares y máquinas.

Está construida con Laravel 11, PHP 8.2, Blade, Bootstrap 5 y MySQL/MariaDB. Su estado actual es el de un **prototipo funcional parcial o preproducción**: la estructura principal existe y algunas pantallas están bastante avanzadas, pero todavía no es segura ni ejecutable directamente desde un clon limpio sin instalar previamente sus dependencias.

## Finalidad y alcance

El modelo funcional previsto es:

- Fabricantes que suministran repuestos.
- Repuestos asociados a un fabricante y un estado.
- Pedidos o albaranes vinculados a un repuesto, estado, usuario, local, bar o máquina.
- Locales con datos de conexión destinados aparentemente a sincronizarse con otro sistema llamado Prometeo.
- Inventario amplio de máquinas y bares mediante seeders.
- Autenticación tradicional de Laravel.

Las pantallas actualmente accesibles desde el menú son fabricantes, repuestos y pedidos, definidas en `resources/views/plantilla/plantilla.blade.php`.

No se ha encontrado una implementación real de la sincronización externa con Prometeo. Actualmente solo existen modelos, comentarios y datos de conexión relacionados con esa futura integración.

## Tecnologías principales

- PHP 8.2.
- Laravel 11.
- Laravel UI para autenticación.
- Blade para las vistas renderizadas en servidor.
- Bootstrap 5 y Bootstrap Icons.
- MySQL/MariaDB como conexión de base de datos predeterminada.
- Vite para la construcción de recursos frontend.
- PHPUnit 10 para pruebas.

## Estado por módulo

| Módulo | Estado actual |
| --- | --- |
| Autenticación | Implementada, pero con configuración contradictoria. |
| Dashboard | Implementado y protegido mediante autenticación. |
| Fabricantes | Listado y borrado disponibles; creación y edición bloqueadas. |
| Repuestos | Listado disponible; creación, edición y borrado bloqueados. |
| Pedidos/albaranes | Es el CRUD más completo del proyecto. |
| Locales | Existen modelo, migración y datos iniciales; el controlador está vacío. |
| Bares | Existen modelo, migración y datos iniciales; el controlador está vacío. |
| Máquinas | Existen modelo, migración y datos iniciales; no hay CRUD ni rutas. |
| Pruebas | Solo permanecen las pruebas de ejemplo generadas por Laravel. |
| Documentación | El README es el genérico de Laravel y no explica el proyecto. |

## Funcionalidad implementada

### Autenticación y panel principal

Laravel UI proporciona las pantallas y controladores de inicio de sesión, recuperación de contraseña, registro y verificación. El controlador del panel principal aplica middleware `auth` y muestra la vista `home`.

### Fabricantes

Existen vistas para listar, crear y editar fabricantes, así como validación y lógica de persistencia en `app/Http/Controllers/FactoryController.php`.

Sin embargo, los métodos `store()` y `update()` comienzan con llamadas `dd($request->all())`. Estas llamadas detienen completamente la petición, por lo que actualmente no se puede crear ni actualizar un fabricante mediante la aplicación.

El listado y el borrado sí están implementados.

### Repuestos

Existen vistas de listado, creación y edición. El listado carga de forma anticipada las relaciones con fabricante y estado para evitar consultas N+1.

La creación, actualización y eliminación están bloqueadas por llamadas `dd(...)` en `app/Http/Controllers/SparePartController.php`.

### Pedidos o albaranes

Es el módulo más completo. `app/Http/Controllers/DeliveryNoteController.php` incluye:

- Listado paginado.
- Carga anticipada de relaciones.
- Formulario de creación.
- Validación y almacenamiento.
- Formulario de edición.
- Actualización.
- Eliminación.

Cada pedido puede relacionarse con un repuesto, estado, local, bar, máquina y usuario, además de incluir un comentario.

### Locales, bares y máquinas

Los modelos, migraciones y seeders existen, pero su administración desde la interfaz está incompleta:

- `LocalController` contiene únicamente métodos vacíos generados como plantilla.
- `BarController` contiene únicamente métodos vacíos generados como plantilla.
- No existe un controlador CRUD operativo para máquinas.
- No existen rutas de recurso para locales, bares o máquinas.
- No existen vistas CRUD completas para esos módulos.

## Problemas y riesgos importantes

### 1. Información sensible versionada

Los seeders contienen información que parece real:

- Contraseñas predeterminadas de usuarios.
- Direcciones IP y puertos.
- Usuarios y contraseñas de bases de datos.
- Nombres, documentos fiscales y direcciones de titulares de establecimientos.

Los archivos principales afectados son:

- `database/seeders/UsersSeeder.php`.
- `database/seeders/LocalSeeder.php`.
- `database/seeders/BarSeeder.php`.

Si estos datos son reales, deben considerarse comprometidos por estar presentes en Git. Se recomienda rotar inmediatamente las credenciales, sustituir los datos por fixtures ficticios y sanear el historial del repositorio.

### 2. Rutas de administración sin protección

Las rutas de fabricantes, repuestos y albaranes se registran mediante `Route::resource` sin middleware `auth` en `routes/web.php`.

Aunque el dashboard sí exige autenticación, un visitante podría acceder directamente a los CRUD sin iniciar sesión. Las operaciones mutables siguen teniendo protección CSRF, pero eso no sustituye la autorización y autenticación necesarias.

### 3. Registro público reactivado accidentalmente

En `routes/web.php` primero se ejecuta:

```php
Auth::routes([
    'register' => false,
]);
```

Más adelante se vuelve a ejecutar `Auth::routes()` sin opciones. Esta segunda llamada vuelve a registrar la ruta de alta de usuarios y anula en la práctica la intención de desactivar el registro público.

### 4. Bloqueos de depuración activos

Las llamadas `dd(...)` detienen el flujo de ejecución antes de validar o guardar datos:

- `FactoryController::store()`.
- `FactoryController::update()`.
- `SparePartController::store()`.
- `SparePartController::update()`.
- `SparePartController::destroy()`.

Estas llamadas deben retirarse antes de que dichos CRUD puedan considerarse operativos.

### 5. Rutas de recurso con métodos ausentes

`Route::resource` registra automáticamente la acción `show`, pero `FactoryController`, `SparePartController` y `DeliveryNoteController` no implementan ese método.

Por tanto, acceder directamente a rutas como `/factories/{factory}`, `/spareparts/{sparepart}` o `/deliverynotes/{deliverynote}` puede producir un error. Se debe implementar `show()` o limitar las rutas con `except('show')`.

### 6. Incoherencias entre modelos, controladores y migraciones

#### Modelo Bar

`app/Models/Bar.php` solo incluye `name` en `$fillable`, pero el seeder intenta asignar también:

- `holder`.
- `dni_cif`.
- `address`.
- `town`.

Laravel descartará esos atributos durante la asignación masiva. Como las columnas son obligatorias en la migración, la carga de datos probablemente fallará por una restricción `NOT NULL`.

#### Modelo Machine

`app/Models/Machine.php` no incluye `bar_id` en `$fillable`. El seeder intenta crear máquinas asociadas a bares mediante asignación masiva, pero ese campo será descartado y las máquinas quedarán sin su relación con el bar.

#### Estado de un repuesto

La migración de `spare_parts` define `state_id` como obligatorio, mientras que `SparePartController` lo valida como `nullable`. Una petición sin estado puede superar la validación y fallar después al insertarse en la base de datos.

#### Restricciones de fabricantes

El controlador exige correo electrónico y CIF únicos, pero la migración permite valores nulos y no crea índices únicos para esas columnas. La aplicación intenta mantener la unicidad mediante validación, pero la base de datos no la garantiza.

### 7. Seeders frágiles

El orden establecido en `database/seeders/DatabaseSeeder.php` es:

1. Usuarios.
2. Locales.
3. Bares.
4. Máquinas.
5. Fabricantes.
6. Estados.
7. Repuestos.
8. Albaranes.

`UsersSeeder` intenta crear usuarios derivados de los locales, pero se ejecuta antes de que existan dichos locales. La consulta devuelve una colección vacía y esos usuarios no se crean.

Además:

- `SparePartSeeder` depende de identificadores numéricos fijos de fabricantes.
- `MachinesSeeder` asume que determinados nombres de bares y locales existen exactamente.
- Algunos seeders no son idempotentes y pueden generar duplicados o restricciones incumplidas al ejecutarse varias veces.

### 8. Base de datos MySQL/MariaDB activa

El entorno local está conectado a la base `workshop` de MariaDB 10.4 mediante el controlador MySQL de Laravel. La base ya existente contiene las diez migraciones y los datos funcionales del taller, incluyendo usuarios, fabricantes, estados, repuestos, locales, bares, máquinas y albaranes.

La configuración utiliza `utf8mb4` con `utf8mb4_general_ci`, compatible con la versión de MariaDB incluida en XAMPP. El archivo SQLite local se conserva como respaldo, pero ya no es la base activa.

El archivo SQLite antiguo llamado `workshop` que permanece versionado en la raíz no se utiliza por la aplicación y debería revisarse en una limpieza posterior del repositorio.

### 9. Entorno local preparado

Actualmente están disponibles:

- `.env` con configuración local para MySQL.
- El directorio `vendor` con las dependencias de Composer.
- Una clave de aplicación válida.
- Todas las migraciones aplicadas en MySQL.

El directorio `node_modules` sigue sin estar instalado, por lo que `npm run build` todavía no puede ejecutar Vite. Esto no impide el arranque actual porque las vistas principales utilizan recursos públicos ya disponibles y la directiva Vite del layout está desactivada.

### 10. Cobertura de pruebas insuficiente

Solo existen las pruebas de ejemplo de Laravel:

- Una prueba unitaria que comprueba que `true` es `true`.
- Una prueba funcional que espera una respuesta `200` en `/`.

La prueba funcional está desactualizada: la ruta `/` redirige a `/login` cuando el usuario no está autenticado, por lo que la respuesta esperable es `302`, no `200`.

No hay pruebas para:

- Autenticación y autorización.
- Fabricantes.
- Repuestos.
- Albaranes.
- Validaciones.
- Relaciones entre modelos.
- Seeders y migraciones.

### 11. Documentación insuficiente

`README.md` conserva casi íntegramente el contenido genérico generado por Laravel. No documenta:

- La finalidad del sistema.
- Los requisitos.
- La instalación.
- Las variables de entorno.
- La preparación de la base de datos.
- Las credenciales de desarrollo seguras.
- Los módulos existentes.
- El despliegue.

## Comprobaciones realizadas

Durante el análisis y la puesta en marcha se realizaron las siguientes comprobaciones:

- Todos los archivos PHP examinados pasan `php -l`.
- Resultado del análisis sintáctico: **0 errores de sintaxis**.
- `composer.json` es válido.
- PHP disponible: versión 8.2.12.
- Node.js disponible: versión 20.13.1.
- npm disponible: versión 10.5.2.
- `php artisan test` arranca correctamente: la prueba unitaria pasa y la prueba funcional de ejemplo falla porque espera `200` en `/`, aunque la aplicación redirige correctamente al login con `302`.
- `npm run build` no puede ejecutarse porque faltan las dependencias de npm.
- Laravel conecta mediante el driver `mysql` a la base `workshop`.
- Las diez migraciones aparecen como ejecutadas.
- `php artisan serve` responde con HTTP 200 en `/login`.
- La rama actual es `main`.
- `main` está sincronizada con `origin/main`.
- El último commit del proyecto es del 10 de noviembre de 2025.

## Aspectos positivos

- La finalidad del proyecto y sus entidades principales están bastante claras.
- Existe una estructura Laravel convencional y reconocible.
- Los archivos PHP no presentan errores sintácticos.
- Las migraciones cubren el dominio principal.
- Las relaciones Eloquent esenciales están iniciadas.
- Las vistas de los tres módulos principales tienen una presentación coherente.
- Los listados utilizan paginación.
- Los controladores más avanzados usan validación de peticiones.
- El listado de albaranes utiliza carga anticipada para evitar consultas N+1.
- El repositorio se encuentra limpio y sincronizado con su rama remota.

## Valoración final

La aplicación tiene un dominio bien encaminado, un diseño visual preparado y una base razonable de modelos, migraciones, controladores y vistas. Sin embargo, **todavía no puede considerarse terminada ni apta para producción**.

El módulo de pedidos o albaranes es el más próximo a ser funcional. Fabricantes y repuestos necesitan retirar bloqueos de depuración. Locales, bares y máquinas necesitan todavía su capa completa de administración.

Los riesgos de seguridad y privacidad tienen prioridad sobre la ampliación funcional, especialmente por la presencia de credenciales y datos personales en el historial del repositorio y por la ausencia de protección en las rutas CRUD.

## Plan recomendado

### Prioridad crítica

1. Rotar todas las credenciales que aparecen en los seeders.
2. Retirar credenciales, direcciones IP y datos personales del repositorio.
3. Sanear el historial Git si los datos son reales.
4. Aplicar middleware `auth` a todas las rutas internas.
5. Desactivar correctamente el registro público.

### Prioridad alta

1. Eliminar todos los `dd(...)` activos.
2. Corregir `$fillable` en `Bar` y `Machine`.
3. Corregir el orden y las dependencias de los seeders.
4. Alinear las reglas de validación con las restricciones de las migraciones.
5. Implementar o excluir las rutas `show`.
6. Sustituir el usuario `root` local por un usuario de MySQL dedicado antes de cualquier despliegue.

### Prioridad media

1. Completar los CRUD de locales, bares y máquinas.
2. Añadir autorización por roles o permisos si existen distintos perfiles de usuario.
3. Crear pruebas de integración para cada CRUD.
4. Crear pruebas de autenticación y acceso no autorizado.
5. Hacer que los seeders sean idempotentes y usen relaciones en vez de identificadores fijos.

### Prioridad posterior

1. Implementar la sincronización real con Prometeo, si sigue siendo un requisito.
2. Documentar instalación, desarrollo, pruebas y despliegue.
3. Revisar la experiencia móvil y la accesibilidad.
4. Configurar integración continua para ejecutar análisis, pruebas y compilación frontend.

## Conclusión

El proyecto debe tratarse como una base de desarrollo avanzada, no como una aplicación lista para usuarios finales. El siguiente hito razonable es obtener una instalación reproducible, segura y con los tres CRUD actuales completamente operativos y probados antes de ampliar los módulos restantes.
