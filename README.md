# Tennis Management

A web app to dynamically manage usage of multiple tennis courts.

## Installation

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm

### Backend Setup

1. Clone the repository:
    ```sh
    git clone https://github.com/LuizBudeu/tenis-management.git
    cd tenis-management
    ```

2. Install PHP dependencies:
    ```sh
    composer install
    ```

3. Copy the example environment file and set your environment variables:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. Run the database migrations:
    ```sh
    php artisan migrate
    ```

### Frontend Setup

1. Navigate to the `frontend` directory:
    ```sh
    cd frontend
    ```

2. Install npm dependencies:
    ```sh
    npm install
    ```

3. Build the frontend assets:
    ```sh
    npm run dev
    ```

---

Access the web app in `http://localhost`
