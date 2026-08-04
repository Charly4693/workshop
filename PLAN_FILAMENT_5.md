# Plan de implementación de Filament 5

Fecha de elaboración: 4 de agosto de 2026.

## 1. Objetivo

Migrar progresivamente la interfaz administrativa de Workshop a Filament 5, conservando la base de datos MySQL/MariaDB, los modelos Eloquent y la aplicación Blade actual mientras se valida el nuevo panel.

La implementación se realizará inicialmente en `/admin`. La interfaz existente continuará disponible como vía de respaldo hasta que los recursos de Filament estén terminados, probados y aceptados.

## 2. Alcance

La primera versión del panel deberá cubrir:

- Autenticación de usuarios.
- Autorización de acceso al panel.
- Gestión de fabricantes.
- Gestión de estados.
- Gestión de repuestos.
- Gestión de pedidos o albaranes.
- Gestión de locales.
- Gestión de bares.
- Gestión de máquinas.
- Gestión restringida de usuarios.
- Dashboard con indicadores básicos.

Quedan fuera de la primera versión:

- La sincronización efectiva con sistemas externos de Prometeo.
- Una API pública.
- Multi-tenancy.
- Aplicación móvil.
- Eliminación inmediata de la interfaz Blade existente.

## 3. Principios de la migración

1. No realizar una reescritura completa.
2. Mantener la interfaz actual durante la transición.
3. No modificar ni eliminar datos existentes sin copia de seguridad.
4. Corregir primero las incoherencias del dominio que puedan afectar a Filament.
5. Aplicar autorización explícita desde el primer recurso.
6. Migrar primero los recursos sencillos y dejar los flujos complejos para fases posteriores.
7. Retirar el código antiguo únicamente cuando exista equivalencia funcional y pruebas.

## 4. Estado técnico de partida

- PHP 8.2.
- Laravel 11.46.
- MySQL mediante MariaDB 10.4 de XAMPP.
- Base de datos activa: `workshop`.
- Autenticación actual proporcionada por Laravel UI.
- Interfaz Blade con Bootstrap 5.
- Dependencias PHP instaladas.
- Dependencias frontend todavía no instaladas en `node_modules`.
- Diez migraciones ejecutadas.
- Datos existentes de usuarios, fabricantes, estados, repuestos, locales, bares, máquinas y albaranes.

El proyecto cumple los requisitos de PHP y Laravel de Filament 5. Será necesario incorporar las dependencias frontend requeridas por Filament y Tailwind CSS 4.1.

## 5. Arquitectura objetivo

La aplicación tendrá temporalmente dos interfaces:

```text
Laravel
├── Interfaz Blade actual
│   ├── Rutas existentes
│   ├── Controladores CRUD actuales
│   └── Bootstrap 5
├── Panel Filament
│   ├── /admin
│   ├── Recursos CRUD
│   ├── Páginas personalizadas
│   ├── Widgets
│   └── Tailwind CSS
├── Modelos Eloquent compartidos
├── Policies compartidas
└── Base MySQL/MariaDB compartida
```

Filament y Blade compartirán los mismos modelos y datos. Los estilos de Bootstrap y Tailwind no deberán mezclarse globalmente; cada interfaz utilizará su propio layout y sus propios recursos.

## 6. Preparación previa

### 6.1. Copias de seguridad

- [x] Crear una copia de seguridad completa de la base `workshop`.
- [x] Verificar que la copia puede restaurarse.
- [x] Crear una rama de trabajo dedicada a Filament.
- [x] Registrar el estado de las migraciones antes de instalar paquetes.
- [x] Registrar los conteos de las tablas principales.

#### Registro de preparación

- Rama: `feature/migracion-filament`.
- Backup verificado: `backups/workshop_verified_20260804_134920.sql`.
- Tamaño: 113.503 bytes.
- SHA-256: `FE2A6377A6318B4222F3CB759CAE71352F31D83987081A527E56B5241ECE8A72`.
- Estructura detectada en el volcado: 16 sentencias `CREATE TABLE`.
- Datos detectados en el volcado: 10 sentencias `INSERT`.
- Marcador de finalización de `mysqldump`: presente.
- Migraciones iniciales: 10 ejecutadas, todas en el lote 1.
- Conteos: 16 usuarios, 16 fabricantes, 5 estados, 17 repuestos, 17 locales, 41 bares, 610 máquinas y 20 albaranes.
- Restauración controlada: completada en una base temporal aislada; los ocho conteos principales coincidieron y la base temporal fue eliminada.

### 6.2. Correcciones del modelo de dominio

- [x] Añadir a `Bar::$fillable` los campos `holder`, `dni_cif`, `address` y `town`.
- [x] Añadir `bar_id` a `Machine::$fillable`.
- [x] Revisar si una máquina debe pertenecer obligatoriamente a un local, a un bar o a uno de los dos.
- [x] Alinear la nulabilidad de `SparePart::state_id` entre migración, modelo y validación.
- [x] Revisar las reglas de eliminación en cascada.
- [x] Revisar la relación jerárquica `Machine::parent_id`.
- [x] Añadir las relaciones inversas que necesiten los Relation Managers.
- [x] Extraer validaciones reutilizables cuando exista lógica compartida.

#### Decisiones de dominio

- Cada máquina debe pertenecer exactamente a un local o a un bar. Se verificaron 610 registros existentes: 561 pertenecen a un local, 49 a un bar y no hay registros con ambas ubicaciones o sin ubicación.
- Una máquina hija debe compartir ubicación con su máquina padre y no se permiten autorreferencias ni ciclos.
- Todos los repuestos deben tener estado; la validación se ha alineado con la columna obligatoria existente.
- Los albaranes se conservan al eliminar entidades relacionadas y sus claves externas pasan a `NULL`.
- No se puede eliminar un local, bar, fabricante o estado mientras mantenga inventario dependiente.
- Al eliminar una máquina padre, las máquinas hijas se conservan y `parent_id` pasa a `NULL`.
- Las reglas compartidas para fabricantes, repuestos, máquinas y albaranes viven en `WorkshopRules`.
- La migración reversible `2026_08_04_140000_harden_foreign_key_delete_rules` se aplicó en el lote 2.

### 6.3. Seguridad de datos

- [ ] Retirar contraseñas e información sensible de los seeders. **Excepción aceptada:** por decisión expresa del propietario, `LocalSeeder` vuelve a incluir las conexiones originales con sus IP y credenciales.
- [ ] Rotar las credenciales expuestas si son reales. **Acción externa pendiente:** requiere acceso a los sistemas propietarios y no puede completarse desde este repositorio.
- [x] Evitar mostrar contraseñas de conexiones locales en tablas o formularios.
- [x] Definir si `dbconection` debe permanecer como JSON o pasar a una entidad protegida.
- [x] Sustituir datos personales reales por fixtures ficticios en desarrollo.

#### Decisiones de seguridad

- Los seeders son idempotentes. `LocalSeeder` es la excepción al uso de datos ficticios: contiene el inventario y las conexiones originales por decisión expresa del propietario.
- El usuario de desarrollo solo se crea si `SEED_ADMIN_PASSWORD` está definido en el entorno.
- `Local::dbconection` permanece temporalmente como JSON para evitar una migración de datos prematura, pero está oculto en la serialización y no se mostrará en recursos Filament.
- Antes de implementar la edición de conexiones se diseñará una entidad cifrada o un almacén de secretos. El JSON actual será de solo lectura o quedará fuera del panel.
- `LocalSeeder` contiene actualmente IP, puertos, usuarios y contraseñas de conexión. El propietario ha aceptado expresamente este riesgo; la rotación y el saneamiento del historial continúan recomendados antes de publicar el repositorio.

### 6.4. Verificación de la preparación

- [x] Ejecutar análisis sintáctico de los archivos PHP modificados.
- [x] Formatear el código PHP con Laravel Pint.
- [x] Ejecutar la suite sobre SQLite en memoria sin tocar MySQL.
- [x] Probar que los seeders son idempotentes.
- [x] Registrar la reintroducción deliberada de datos sensibles en `LocalSeeder` y la aceptación del riesgo.
- [x] Aplicar la migración de endurecimiento sobre MySQL.
- [x] Confirmar que los conteos de datos productivos no cambian.
- [x] Comprobar `/login`, `/factories`, `/spareparts` y `/deliverynotes` mediante HTTP.

Resultado: 7 pruebas y 23 aserciones superadas. Las cuatro pantallas comprobadas responden con HTTP 200 y los conteos principales de MySQL permanecen intactos.

**Estado de la preparación:** completada técnicamente con una excepción de seguridad aceptada por el propietario: `LocalSeeder` conserva las conexiones originales. La rotación de credenciales externas y el saneamiento del historial Git permanecen recomendados antes de publicar o desplegar el repositorio fuera del entorno controlado.

## 7. Fase 1: instalación del panel

### Tareas

- [ ] Instalar `filament/filament` 5.x mediante Composer.
- [ ] Ejecutar la instalación del Panel Builder.
- [ ] No utilizar `filament:install --scaffold`, para evitar sobrescribir archivos existentes.
- [ ] Confirmar el registro de `AdminPanelProvider` en `bootstrap/providers.php`.
- [ ] Configurar el panel con identificador `admin` y ruta `/admin`.
- [ ] Configurar nombre, logotipo, colores y zona horaria.
- [ ] Configurar idioma español.
- [ ] Mantener desactivado el registro público desde el panel.
- [ ] Mantener las rutas Blade actuales sin cambios.
- [ ] Instalar las dependencias frontend necesarias.
- [ ] Compilar los recursos y comprobar que Bootstrap no interfiere con Filament.

### Criterios de aceptación

- `/admin` muestra la pantalla de acceso de Filament.
- La interfaz Blade existente continúa funcionando.
- No se han alterado tablas ni datos de negocio.
- Los recursos frontend compilan sin errores.
- No existen colisiones visuales entre Bootstrap y Tailwind.

## 8. Fase 2: autenticación y autorización

### Modelo de acceso

Antes de desplegar el panel debe decidirse qué usuarios son administradores. La opción recomendada es añadir un campo o sistema explícito de roles, evitando autorizar únicamente por dirección de correo.

Opciones posibles:

- Campo booleano `is_admin` para un único nivel administrativo.
- Campo `role` con varios perfiles.
- Paquete de roles y permisos si se necesita autorización granular.

### Tareas

- [ ] Definir los perfiles funcionales: administrador, taller, técnico y consulta.
- [ ] Implementar `FilamentUser` en el modelo `User`.
- [ ] Implementar `canAccessPanel()`.
- [ ] Impedir el acceso de usuarios no autorizados.
- [ ] Crear Policies para todos los modelos administrados.
- [ ] Activar `strictAuthorization()` en el panel.
- [ ] Decidir si se conserva temporalmente el login de Laravel UI.
- [ ] Deshabilitar el registro público duplicado en `routes/web.php`.
- [ ] Probar accesos autorizados y denegados.

### Criterios de aceptación

- Un administrador puede iniciar sesión en `/admin`.
- Un usuario sin permisos recibe una denegación de acceso.
- Ningún recurso queda accesible por ausencia accidental de una Policy.
- Las operaciones de crear, ver, editar y eliminar respetan los permisos definidos.

## 9. Fase 3: recursos piloto

Los primeros recursos serán los de menor complejidad. Servirán para establecer convenciones de código, navegación, formularios, tablas y pruebas.

### 9.1. StateResource

- [ ] Crear un recurso sencillo gestionado mediante modales.
- [ ] Mostrar nombre y número de repuestos o albaranes relacionados.
- [ ] Impedir eliminar estados que estén siendo utilizados, salvo decisión explícita.
- [ ] Añadir búsqueda y ordenación.

### 9.2. FactoryResource

- [ ] Mostrar nombre, ciudad, teléfono, correo electrónico y CIF.
- [ ] Añadir búsqueda por nombre, ciudad, correo y CIF.
- [ ] Añadir filtros por ciudad.
- [ ] Validar correo y CIF.
- [ ] Evitar duplicados según las reglas de negocio.
- [ ] Añadir Relation Manager de repuestos si resulta útil.

### Criterios de aceptación

- Se pueden listar, crear, editar y eliminar registros según los permisos.
- La validación funciona tanto al crear como al editar.
- No se utilizan controladores ni vistas Blade para estas operaciones dentro de `/admin`.
- Existen pruebas automatizadas para ambos recursos.

## 10. Fase 4: SparePartResource

### Formulario

- [ ] Campo de nombre obligatorio.
- [ ] Selector de fabricante con búsqueda.
- [ ] Selector de estado con búsqueda.
- [ ] Validaciones coherentes con la base de datos.

### Tabla

- [ ] Mostrar nombre, fabricante, estado y fechas relevantes.
- [ ] Buscar por nombre y fabricante.
- [ ] Filtrar por fabricante y estado.
- [ ] Ordenar por nombre y fecha.
- [ ] Añadir acciones individuales y masivas solo cuando sean seguras.

### Criterios de aceptación

- El recurso sustituye funcionalmente al CRUD Blade de repuestos.
- No quedan llamadas `dd(...)` en el flujo nuevo.
- Las relaciones se cargan sin problemas N+1 relevantes.
- Los permisos se comprueban para todas las acciones.

## 11. Fase 5: DeliveryNoteResource

Este será el recurso principal del panel y requerirá mayor diseño funcional.

### Formulario

- [ ] Selección de repuesto.
- [ ] Selección de estado.
- [ ] Selección de usuario responsable.
- [ ] Selección de local o bar.
- [ ] Selección de máquina filtrada por el local o bar elegido.
- [ ] Campo de comentarios.
- [ ] Campos reactivos para evitar combinaciones incoherentes.
- [ ] Validación de que la máquina pertenece a la ubicación seleccionada.

### Tabla

- [ ] Mostrar repuesto, estado, responsable, ubicación, máquina y fecha.
- [ ] Búsqueda global por los campos relevantes.
- [ ] Filtros por estado, usuario, local, bar, máquina y rango de fechas.
- [ ] Indicadores visuales para los estados.
- [ ] Orden predeterminado por registros más recientes.
- [ ] Acciones para cambios frecuentes de estado.

### Flujo de estados

- [ ] Definir las transiciones válidas entre estados.
- [ ] Decidir si los estados de repuestos y albaranes deben compartir la misma tabla.
- [ ] Registrar quién realiza cada cambio si se necesita trazabilidad.
- [ ] Considerar una tabla de historial de estados.

### Criterios de aceptación

- El recurso cubre creación, consulta, edición y eliminación de albaranes.
- Las combinaciones de local, bar y máquina son coherentes.
- Los filtros responden con el volumen actual de datos.
- Las acciones sensibles están autorizadas y, si procede, usan transacciones.

## 12. Fase 6: locales, bares y máquinas

### LocalResource

- [ ] Gestionar nombre e identificadores operativos.
- [ ] Proteger la información de conexión.
- [ ] Mostrar máquinas relacionadas mediante Relation Manager.
- [ ] Evitar que las credenciales aparezcan en listados, logs o exportaciones.

### BarResource

- [ ] Gestionar nombre, titular, documento fiscal, dirección y población.
- [ ] Mostrar máquinas relacionadas.
- [ ] Buscar por nombre, titular, población y documento fiscal.
- [ ] Proteger los datos personales según los perfiles de usuario.

### MachineResource

- [ ] Gestionar nombre, alias, identificador y tipo.
- [ ] Permitir asociación con local o bar.
- [ ] Gestionar la relación padre-hijo.
- [ ] Filtrar por ubicación, tipo y máquina padre.
- [ ] Impedir ciclos en la jerarquía.
- [ ] Mostrar hijos y ubicación mediante Relation Managers o páginas relacionadas.

### Criterios de aceptación

- Los tres recursos gestionan correctamente sus relaciones.
- Una máquina no queda asociada simultáneamente de forma incoherente.
- No se exponen credenciales de conexión.
- La jerarquía de máquinas no permite ciclos.

## 13. Fase 7: usuarios

### Tareas

- [ ] Crear `UserResource` visible únicamente para administradores autorizados.
- [ ] Mostrar nombre, correo, rol y estado de verificación.
- [ ] Permitir restablecer o cambiar contraseñas de forma segura.
- [ ] No mostrar hashes ni contraseñas existentes.
- [ ] Impedir que un administrador elimine accidentalmente su propia cuenta.
- [ ] Registrar cambios relevantes de permisos.
- [ ] Valorar MFA para administradores.

### Criterios de aceptación

- Solo los perfiles autorizados pueden gestionar usuarios.
- Las contraseñas siempre se almacenan con hash.
- Los cambios de rol se validan y quedan protegidos.

## 14. Fase 8: dashboard y experiencia de uso

### Widgets iniciales

- [ ] Total de albaranes abiertos.
- [ ] Albaranes por estado.
- [ ] Repuestos por estado.
- [ ] Últimos albaranes creados.
- [ ] Máquinas por local o bar.
- [ ] Actividad reciente, si se implementa auditoría.

### Navegación propuesta

```text
Dashboard
├── Taller
│   ├── Pedidos / Albaranes
│   ├── Repuestos
│   └── Estados
├── Ubicaciones
│   ├── Locales
│   └── Bares
├── Inventario
│   └── Máquinas
├── Proveedores
│   └── Fabricantes
└── Administración
    └── Usuarios
```

### Criterios de aceptación

- El menú refleja el vocabulario utilizado por los usuarios del taller.
- Los widgets no realizan consultas excesivas.
- La navegación funciona en escritorio y móvil.
- Los textos se muestran en español.

## 15. Estrategia de pruebas

### Pruebas de dominio

- [ ] Relaciones entre modelos.
- [ ] Reglas de asignación de local o bar a una máquina.
- [ ] Jerarquía padre-hijo de máquinas.
- [ ] Transiciones de estados.
- [ ] Validaciones reutilizadas por Filament.

### Pruebas de recursos

- [ ] Acceso a listados.
- [ ] Creación de registros.
- [ ] Edición de registros.
- [ ] Eliminación y restricciones.
- [ ] Búsquedas y filtros.
- [ ] Acciones individuales y masivas.
- [ ] Campos reactivos.

### Pruebas de seguridad

- [ ] Usuario no autenticado.
- [ ] Usuario autenticado sin acceso al panel.
- [ ] Usuario con permisos de solo lectura.
- [ ] Usuario con permisos de edición.
- [ ] Administrador.
- [ ] Acciones personalizadas y llamadas Livewire.

### Pruebas de regresión

- [ ] La interfaz Blade existente continúa funcionando durante la migración.
- [ ] Las operaciones realizadas desde Filament son visibles en la interfaz antigua.
- [ ] Las operaciones antiguas son visibles en Filament.
- [ ] Las sesiones y el inicio de sesión siguen funcionando.

## 16. Observabilidad y auditoría

- [ ] Configurar logs de errores de Filament y Livewire.
- [ ] Evitar registrar contraseñas, tokens o conexiones completas.
- [ ] Valorar un historial de cambios para albaranes y permisos.
- [ ] Registrar actor, fecha y operación en acciones críticas.
- [ ] Añadir indicadores para errores recurrentes y trabajos fallidos.

## 17. Rendimiento

- [ ] Revisar consultas N+1 en columnas relacionadas.
- [ ] Añadir índices a campos utilizados en filtros y búsquedas.
- [ ] Limitar opciones precargadas en selects con muchos registros.
- [ ] Utilizar búsquedas remotas para relaciones grandes.
- [ ] Paginar listados.
- [ ] Medir widgets y consultas del dashboard.
- [ ] Probar el recurso de máquinas con el volumen real existente.

## 18. Despliegue progresivo

### Entorno local

- [ ] Instalar y configurar Filament.
- [ ] Ejecutar migraciones nuevas.
- [ ] Crear recursos y pruebas.
- [ ] Validar con una copia de los datos.

### Entorno de pruebas

- [ ] Restaurar una copia anonimizada de producción.
- [ ] Probar permisos con diferentes perfiles.
- [ ] Ejecutar la suite completa.
- [ ] Validar tiempos de carga.
- [ ] Obtener aceptación de usuarios del taller.

### Producción

- [ ] Crear copia de seguridad inmediatamente antes del despliegue.
- [ ] Instalar dependencias con versiones bloqueadas.
- [ ] Ejecutar migraciones con procedimiento de reversión.
- [ ] Compilar recursos frontend para producción.
- [ ] Limpiar y reconstruir cachés de Laravel.
- [ ] Habilitar `/admin` solo para usuarios autorizados.
- [ ] Mantener temporalmente la interfaz anterior.
- [ ] Monitorizar errores y rendimiento.

## 19. Retirada de la interfaz antigua

La retirada se realizará módulo a módulo, no de una sola vez.

Para retirar un CRUD antiguo deben cumplirse estas condiciones:

- [ ] Existe un recurso Filament equivalente.
- [ ] Se han validado todas sus operaciones.
- [ ] Existen Policies y pruebas de autorización.
- [ ] Los usuarios responsables han aceptado el nuevo flujo.
- [ ] No quedan enlaces internos dependientes de las rutas antiguas.
- [ ] Existe un procedimiento de reversión.

Después de cumplirlas:

- [ ] Redirigir las rutas antiguas al recurso correspondiente.
- [ ] Observar el comportamiento durante un periodo acordado.
- [ ] Eliminar las vistas Blade obsoletas.
- [ ] Eliminar los controladores sin uso.
- [ ] Eliminar las rutas antiguas.
- [ ] Retirar estilos y scripts exclusivos de la interfaz eliminada.
- [ ] Evaluar la retirada de Laravel UI si Filament asume toda la autenticación.

## 20. Estrategia de reversión

- Mantener la interfaz Blade durante toda la migración.
- No eliminar columnas ni tablas en las primeras fases.
- Realizar nuevas migraciones de manera reversible.
- Conservar copias de seguridad verificadas.
- Poder desregistrar temporalmente el panel Filament sin afectar a los modelos.
- Revertir el despliegue de código antes de restaurar la base, salvo que una migración haya modificado datos.
- Documentar cualquier transformación irreversible antes de ejecutarla.

## 21. Riesgos y mitigaciones

| Riesgo | Impacto | Mitigación |
| --- | --- | --- |
| Acceso administrativo demasiado amplio | Crítico | `FilamentUser`, Policies y `strictAuthorization()`. |
| Exposición de credenciales de locales | Crítico | Campos protegidos, cifrado y exclusión de tablas y logs. |
| Incoherencias actuales del modelo | Alto | Corregirlas antes de generar recursos complejos. |
| Colisión entre Bootstrap y Tailwind | Medio | Layouts y recursos separados. |
| Pérdida o alteración de datos | Alto | Copias verificadas y migraciones reversibles. |
| Dependencia excesiva de código generado | Medio | Convenciones, revisión y servicios de dominio. |
| Acciones Livewire no autorizadas | Alto | Policies, autorización explícita y pruebas. |
| Consultas lentas en máquinas y relaciones | Medio | Índices, búsqueda remota, paginación y medición. |
| Duplicidad temporal de interfaces | Medio | Calendario de retirada y equivalencia funcional documentada. |

## 22. Orden recomendado de implementación

1. Copia de seguridad y rama de trabajo.
2. Correcciones de modelos y seguridad de seeders.
3. Instalación del panel en `/admin`.
4. Autenticación, roles, Policies y autorización estricta.
5. `StateResource`.
6. `FactoryResource`.
7. `SparePartResource`.
8. `DeliveryNoteResource`.
9. `LocalResource`.
10. `BarResource`.
11. `MachineResource`.
12. `UserResource`.
13. Dashboard y widgets.
14. Pruebas integrales y aceptación de usuarios.
15. Retirada progresiva de la interfaz Blade.

## 23. Definición de terminado

La migración se considerará terminada cuando:

- Todos los módulos administrativos estén disponibles en Filament.
- La autorización esté definida mediante Policies y cubierta por pruebas.
- No se expongan credenciales ni información sensible.
- Los flujos principales hayan sido validados por usuarios reales.
- Las búsquedas, filtros y formularios respondan correctamente con el volumen real.
- Exista una suite de pruebas estable.
- El despliegue y la reversión estén documentados.
- Las rutas, controladores y vistas antiguas hayan sido retirados o declarados explícitamente necesarios.
- `ESTADO.md` y el README reflejen la arquitectura final.

## 24. Primer hito propuesto

El primer hito será un piloto completamente reversible con:

- Filament 5 instalado en `/admin`.
- Acceso restringido a administradores.
- Autorización estricta activa.
- `StateResource` operativo.
- `FactoryResource` operativo.
- Pruebas de autenticación, autorización y CRUD.
- Interfaz Blade intacta.

La continuación hacia repuestos y albaranes dependerá de la aceptación técnica y funcional de este piloto.
