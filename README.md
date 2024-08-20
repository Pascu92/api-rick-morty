# Instalacion
ejecuta

    composer install
    cp .env.example .env
    php artisan key:generate

# DB
.env

    DB_CONNECTION=sqlite
ejecuta

    php artisan migrate
    php artisan serve

# Endpoints

-   **register**

    -   URL: `http://127.0.0.1:8000/api/login`
    -   Método: `POST`
    -   Body:
        -   `{ "email": "jose@example.com", "password": "123456" }`
        

-   **login**

    -   URL: `http://127.0.0.1:8000/api/login`
    -   Método: `POST`
    -   Body:
        -   `{ "email": "jose@example.com", "password": "123456" }`
    -   Aqui recibiremos un access token

-   **addCharacter**

    -   URL: `http://127.0.0.1:8000/api/characters`
    -   Método: `POST`
    -   Headers:
        -   `Authorization: Bearer <tu_access_token>`
        -   `Content-Type: application/json`
    -   Body:
        -   `{ "character_id": 1 }`

-   **listApiCharacters**

    -   URL: `http://127.0.0.1:8000/api/characters/api`
    -   Método: `GET`
    -   Headers:
        -   `Authorization: Bearer <tu_access_token>`
    -   Query Parameters (opcional):
        -   `page`: Número de página (por defecto es 1)

-   **listCharacters**

    -   URL: `http://127.0.0.1:8000/api/characters`
    -   Método: `GET`
    -   Headers:
        -   `Authorization: Bearer <tu_access_token>`
    -   Query Parameters (opcional):
        -   `name`: Filtra por nombre del personaje
        -   `status`: Filtra por estado del personaje (`Alive`, `Dead`, `unknown`)
        -   `species`: Filtra por especie del personaje
        -   `gender`: Filtra por género del personaje
        -   `page`: Número de página

-   **deleteCharacter**

    -   URL: `http://127.0.0.1:8000/api/characters/{character_id}`
    -   Método: `DELETE`
    -   Headers:
        -   `Authorization: Bearer <tu_access_token>`
    -   Path Parameter:
        -   `{character_id}`: El ID del personaje que deseas eliminar

