# Event Management System

A pure PHP web application. This is pure PHP, no framework is used. But I'm inspired by the Laravel framework.

## Introduction

The Event Management System is a web-based application designed to help users plan, organize, and manage events efficiently. The goal of this project is to develop a simple, web-based event management system that allows users to create, manage, and view events, as well as register attendees and generate event reports.

## Demo usage

**Demo URL:** https://event.abdulmajid.dev/

- Visit the demo URL and register your account if you don't have an account yet.
- After login, you may see your dashaboard where has event list, create, edit and delete feature.
- After creating event, anyone can see these events in homepage.
- Anyone can see event list in homepage and read details.
- An attendee must be register in an event from event details page.
- Admin can see his events attendee list and can download attendee report as CSV file.
- For event details API endpoint: `https://event.abdulmajid.dev/api/event-details?id=3`
- Here `id` is an event id.

## Features

- User Authentication
- User Profile & Password Change option
- Event Management
- Attendee Registration
- Event Dashboard
- Event Report
- Event details API endpoint `{app_url}/api/event-details?id={event_id}`
- Security
- and more...

## Installation

- _PHP requirements: PHP >= 8.2_

1. Clone the repository:
   ```bash
   git clone https://github.com/abdulmajidcse/event-management.git
   ```
2. Navigate to the project directory:
   ```bash
   cd event-management
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Create a database and import a database which is included your project root directory called `event_management.sql`.

5. Update your `config/app.php` file for database credentials.

## Usage

1. Start the development server:

   ```bash
   php -S localhost:8000 -t public
   ```

   Or you may use other option. Suppose your development server support custom domain (e.g., http://event-management.test) or you may use directory location (e.g., http://localhost/event-management/public). If you choose other option, you don't need to run `php -S localhost:8000 -t public` command.

   However, here we'll use `http://localhost:8000`. you must update your `config/app.php` file for updating your app and asset URL.

2. Open your browser and navigate to `http://localhost:8000`.

## Deployment

It's almost same as other PHP application deployment process.
<br/>

- But remember one thing, you must define `public` directory as your project root directory.
- set `debug` = `false` from `config/app.php`

### Thank you!
