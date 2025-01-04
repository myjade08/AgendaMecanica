# AgendaMecanica
![image](https://github.com/user-attachments/assets/b46ae643-712e-4910-bb26-9947673f554e)


## Descripción General
**AgendaMecanica** es una aplicación web construida con Filament, diseñada para modernizar y simplificar la gestión de reservas de turnos en talleres mecánicos. Esta solución digital permite a los usuarios seleccionar y programar servicios mecánicos de forma rápida y eficiente, ofreciendo una interfaz clara y accesible para mejorar la experiencia de usuario y optimizar las operaciones del taller.

## Funcionalidades Principales
- **Reserva de Turnos:** La plataforma facilita la elección de fechas y horas disponibles, permitiendo a los usuarios reservar el momento que mejor se adapte a sus necesidades.
- **Gestión de Clientes:** Los administradores pueden gestionar información del cliente, historial de servicios y seguimientos post-servicio, todo mediante la administración sencilla que proporciona Filament.

## Tecnologías Utilizadas
Este proyecto utiliza varias tecnologías modernas para su implementación:
- **Frontend y Backend:** Filament, un kit de herramientas de administración para Laravel, que proporciona un robusto sistema de backend y un bello diseño de frontend.
- **Base de Datos:** MySQL, elegida por su fiabilidad y amplia adopción en aplicaciones web.
- **Autenticación:** Fortify, para una gestión segura de sesiones y autenticación de usuarios.

## Requisitos del Sistema
Para ejecutar esta aplicación, necesitarás:
- PHP versión 8.0 o superior.
- MySQL corriendo localmente o en un servidor remoto.
- Composer para la gestión de dependencias PHP.

## Instalación y Configuración
1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/myjade08/AgendaMecanica.git
   cd AgendaMecanica
   composer install
   php artisan serve
