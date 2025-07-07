# Laravel Blog System

## Overview

The **Laravel Blog System** is a Laravel-based web application for creating and managing blog posts using the Quill.js rich-text editor. Designed for a single authenticated user, the system includes a clean, responsive interface and leverages Laravel's policy system to handle authorization for blog post management and other actions.

## Features

* **User Authentication**
  * Secure login system allowing each user to manage their own blog content.

* **Post Management**
  * Create, edit, and delete your own blog posts.
  * Organize posts using **categories**.
  * **View counter**: Each post tracks and displays the number of views, increasing automatically when accessed.

* **Comment System**
  * Users can add comments to blog posts.
  * Comment authors can **edit** or **delete** their own comments.
  * Post owners can **delete any comment** on their own posts.

* **Post Likes**
  * Users can "like" blog posts.
  * Users can view a list of **posts they have liked**.

* **User Profile Management**
  * Edit personal account information.
  * Delete account securely from the system.

* **Search Functionality**
  * Search **posts by title** and **users by name**.

* **Authorization with Laravel Policies**
  * All actions — including post, comment, like, profile, and media operations — are protected using **Laravel’s policy system** for structured and secure access control.

* **Quill.js Rich Text Editor**
  * A clean, modern WYSIWYG editor for writing and formatting blog content with rich text and embedded images.

* **Responsive Design**
  * Fully responsive layout built with **Tailwind CSS**, optimized for all devices.

* **FontAwesome Icons**
  * Clear and consistent iconography used throughout the interface for enhanced usability.

## Technologies Used

* **Frontend**: Tailwind CSS, FontAwesome Icon, Quill JS
* **Backend**: Laravel (PHP)
* **Database**: SQLite

## Installation

### Clone the Repository

```bash
git clone https://github.com/TaraDesk/laravel-blog-system.git
cd laravel-blog-system
```

### Install Dependencies

```bash
composer install
npm install && npm run dev
```

### Setup Environment

1. Copy the `.env` file:

   ```bash
   cp .env.example .env
   ```
2. Update the `.env` file with your local database details.

### Generate Application Key

```bash
php artisan key:generate
```

### Setup Database

1. Create a new database.
2. Run migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

### Link Storage into Public Folder 

```bash
php artisan storage:link
```

### Run the Application

```bash
php artisan serve
```

Open in your browser:
[http://localhost:8000](http://localhost:8000)


## Usage

* **Register an Account**: Anyone can sign up with an email and password to start creating and interacting with blog content.
* **Login** : Registered users can securely log in to manage their content.

* **Post Management** : 
  * Create, edit and delete blog posts.
  * Organize posts using categories and tags.
  * Track post views.

* **Comment Moderation** :
  * Review, edit, or delete your own comments.
  * Delete inappropriate or unwanted comments from others on your posts.

* **User Interaction** : Users can view blog posts, leave comments, like posts, and see post view counts.
* **Search Functionality** : Search posts by title and users by name.
* **Account Management** : Update personal information and Securely delete your account if desired.
* **Authorization** : All sensitive actions are protected using Laravel’s policy system to ensure only authorized access is permitted.

