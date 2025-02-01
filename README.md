# Event Management System

## Introduction
The Event Management System is a web-based application designed to help users plan, organize, and manage events efficiently. The goal of this project is to develop a simple, web-based event management system that allows users to create, manage, and view events, as well as register attendees and generate event reports.

## Features
- User Authentication
- User Profile & Password Change option
- Event Management
- Attendee Registration
- Event Dashboard
- Event Report
- Security
- and more...

## Installation
- *PHP requirements: PHP >= 8.2*

1. Start your development server.

2. Clone the repository:
    ```bash
    git clone https://github.com/abdulmajidcse/event-management.git
    ```
3. Navigate to the project directory:
    ```bash
    cd event-management
    ```
4. Install dependencies:
    ```bash
    composer install
    ```
5. Create a database and import a database which is included your project root directory called `event_management.sql`.

6. Update your `config/app.php` file for database credentials.

## Usage
1. Start the development server:
    ```bash
    php -S localhost:8000 -t public
    ```

    Or you may use other option. Suppose your development server support custom domain (e.g., http://event-management.test) or you may use directory location (e.g., http://localhost/event-management/public). If you choose other option, you don't need to run `php -S localhost:8000 -t public` command.

    However, here we'll use `http://localhost:8000`. you must update your `config/app.php` file for updating your app and asset URL.

2. Open your browser and navigate to `http://localhost:8000`.

### Thank you!