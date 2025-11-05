# 💬 Chat and Community Platform

Welcome to the repository for a modern, feature-rich chat and community platform built with Laravel. This application allows users to connect, share content, and engage in real-time interactions, mimicking the core functionalities of contemporary social networks.

## ✨ Key Features

* **Real-time Chat:** Instant messaging using **Laravel Reverb** (WebSockets).
* **User Posts:** Ability for users to create and share content.
* **Voting System:** Upvote/downvote functionality on posts.
* **Friendship System:** Logic for adding, accepting, and managing friends.
* **Asynchronous Processing:** Utilizing **Laravel Queues** for heavy tasks (e.g., sending emails to subscribers, processing large files).

## 🛠️ Technology Stack

| Category | Technology 
| :--- | :--- | :--- |
| **Backend** | Laravel 12 (PHP) | 
| **Database** | MySQL |
| **Real-time** | Laravel Reverb |
| **Frontend** | Tailwind CSS, Alpine.js (Optional) |
| **Queues** | Laravel Queue System | 


---

## 🚀 Getting Started

Follow these steps to set up and run the project on your local machine.

### Prerequisites

Ensure you have the following installed on your system:

* PHP (8.2+)
* Composer
* Node.js & npm
* MySQL

### 1. Installation

1.  **Clone the Repository:**
    ```bash
    git clone [YOUR_REPO_URL]
    cd [your-project-name]
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node Dependencies:**
    ```bash
    npm install
    ```

4.  **Configure Environment:**
    * Duplicate the example environment file:
        ```bash
        cp .env.example .env
        ```
    * Open the `.env` file and configure your **Database credentials** and ensure the `BROADCAST_DRIVER` is set to `reverb` and `QUEUE_CONNECTION` is set to your desired driver (e.g., `database`, `redis`).

5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run Database Migrations and Seeding:**
    ```bash
    php artisan migrate --seed
    ```

### 2. Running the Application

This project requires **four separate processes** to be running concurrently to enable all real-time and background features.

Open **four separate terminal windows** inside the project root directory and run one command in each:

#### Terminal 1: Application Server

This serves the main Laravel application (HTTP).

```bash
php artisan serve
```
#### Terminal 2: Frontend Assets Watcher

This compiles and watches your Tailwind CSS and JavaScript assets, ensuring frontend changes are reflected instantly.

```bash
npm run dev
```
#### Terminal 3: Queue Worker

This constantly processes any queued jobs (e.g., sending subscription emails, heavy data processing). **Crucial for mail and background logic!**

```bash
php artisan queue:work
```

#### Terminal 4: Laravel Reverb Server

This starts the dedicated WebSocket server for real-time chat and notifications. **Essential for real-time features like instant messaging.**

```bash
php artisan reverb:start
```
Once all four commands are running, your application should be fully operational and accessible at http://127.0.0.1:8000 (or the port specified by ```php artisan serve```).

