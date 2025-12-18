# Magic Inc/Dec number 🪄

Esta es una utilidad de JavaScript que implementa una lógica de incremento y decremento "mágica". Esta función opera sobre el **primer dígito significativo** y ajusta el **orden de magnitud** (exponente) del número de forma automática.

---

## 🚀 Entorno de Ejecución (Docker)

Para facilitar las pruebas y el despliegue de este proyecto, se incluye una configuración de **Docker** con **PHP 8.0**, ideal si deseas integrar esta lógica en un entorno web.

### 📋 Requisitos
* **Docker** instalado.
* **Docker Compose**.

### ⚙️ Instalación y Despliegue

1.  **Levantar el servidor**:
    Ejecuta el siguiente comando en la raíz del proyecto para construir y lanzar el contenedor:
    ```bash
    docker-compose up -d
    ```

2.  **Acceso**:
    El servidor estará disponible en: 👉 **[http://localhost:8080](http://localhost:8080)**

## 🛠️ Comandos Útiles de Docker

Aquí tienes una guía rápida para administrar tu contenedor una vez instalado:
| Acción | Comando | Descripción |
| :--- | :--- | :--- |
| **Iniciar** | `docker-compose up -d` | Levanta el servidor en segundo plano. |
| **Detener** | `docker-compose stop` | Detiene los contenedores sin eliminarlos. |
| **Apagar** | `docker-compose down` | Detiene y elimina los contenedores y redes creadas. |
| **Reconstruir** | `docker-compose up -d --build` | Aplica cambios realizados en el `Dockerfile`. |
| **Logs** | `docker-compose logs -f` | Muestra la salida de la consola en tiempo real. |
| **Estado** | `docker-compose ps` | Verifica si el contenedor está corriendo correctamente. |
| **Terminal** | `docker exec -it php8_server bash` | Entra a la consola interna del servidor. |

---