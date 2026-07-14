# Laravel API Orders

REST API на **Laravel **, развёрнутое в **Docker**.  
Проект реализует выгрузку и фильтрацию данных по четырем сущностям:
- **Продажи (Sales)**
- **Заказы (Orders)**
- **Склады (Stocks)**
- **Доходы (Incomes)**

Авторизация выполняется по **секретному токену**, передаваемому в параметре `key`.  
Все эндпоинты возвращают **JSON** с **пагинацией** и поддерживают фильтрацию по дате.

---

## Стек 

- **PHP 8.2**
- **Laravel**
- **Laravel Octane (Swoole)**
- **MySQL**
- **Docker / docker-compose**

---

## Структура проекта

app/
├── DTOs/               # DTO-объекты для валидации и передачи данных
├── Http/
│   ├── Controllers/    # Контроллеры (Sales, Orders, Stocks, Incomes)
│   ├── Middleware/     # ApiKeyAuth — проверка API ключа
├── Models/             # Модели Eloquent
└── Services/           # Логика бизнес-слоя

---

## Запуск проекта

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/dartanool/laravel-api-orders.git
   cd laravel-api-orders
2. Создать файл .env
    ```bash
    cp .env.example .env
3. Настроить переменные окружения (доступы к БД и ключ API):
    ```bash
    DB_DATABASE=wbapi
    DB_USERNAME=wbuser
    DB_PASSWORD=wbpassword
    API_KEY=секретный_ключ
4. Поднять контейнеры:
    ```bash
    docker-compose up -d --build
5. Выполнить миграции:
    ```bash
   docker exec -it php-fpm bash 
   php artisan migrate

---

## Авторизация

1. Каждый запрос должен содержать параметр key с вашим токеном:
    ```bash
    /api/sales?dateFrom=2025-10-01 12:00:00&dateTo=2025-10-23 12:00:00&page=1&limit=100&key=секретный_ключ

2. Без корректного токена сервер возвращает:
    ```bash
    {"error": "Unauthorized"}

---

## Основная логика

- Проверка API ключа выполняется через middleware ApiKeyAuth.
- DTO (например, SaleDTO) собирает входные параметры запроса.
- Сервисы (SaleService, OrderService и т.д.) обрабатывают бизнес-логику.
- Контроллеры возвращают JSON-ответ с пагинацией.
