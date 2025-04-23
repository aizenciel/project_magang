# Admin Dashboard

A comprehensive web-based inventory and item management system built with Laravel.

## Overview

This application provides a centralized platform for administrators to manage inventory items, track checkout requests, and monitor stock levels. It features a user-friendly interface for efficient item management with image upload capabilities.

## Features

### Item Management
- Create, view, edit, and delete inventory items
- Upload and manage item images
- Track detailed item information (item code, INC, type, group, UOM, etc.)
- Monitor stock levels with max stock level and reorder point tracking

### Checkout System
- Process and manage checkout requests
- Track item checkout history
- User-friendly checkout interface

### User Interface
- Modern, responsive dashboard
- Search and filtering capabilities
- Role-based access control
- Secure authentication system

## Installation & Setup

### Requirements
- PHP >= 8.0
- Composer
- MySQL/MariaDB
- Node.js and NPM

### Installation Steps

1. **Clone the repository**
   ```
   git clone [repository-url]
   cd admin-dashboard
   ```

2. **Install PHP dependencies**
   ```
   composer install
   ```

3. **Install NPM dependencies**
   ```
   npm install
   ```

4. **Environment Configuration**
   ```
   cp .env.example .env
   php artisan key:generate
   ```
   
   Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=admin_dashboard
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Database Setup**
   ```
   php artisan migrate
   php artisan db:seed
   ```

6. **Create storage link for file uploads**
   ```
   php artisan storage:link
   ```

7. **Build assets**
   ```
   npm run dev
   ```

8. **Create storage directories**
   ```
   mkdir -p storage/app/public/items
   ```

9. **Set proper permissions**
   - For Unix/Linux:
     ```
     chmod -R 775 storage
     chmod -R 775 bootstrap/cache
     ```
   - For Windows: ensure the web server has write access to these directories

## Running the Application

### Development
```
php artisan serve
```
Access the application at http://localhost:8000

### Production
Configure your web server (Apache/Nginx) to point to the public directory.

## Usage

### Authentication
- Access the login page at `/login`
- Default admin credentials (if using seeded data):
  - Email: admin@example.com
  - Password: password

### Managing Items
1. Navigate to `Items` in the dashboard
2. Use `Create Item` button to add new items
3. Upload images using the image upload field
4. View, edit or delete items from the item list

### Processing Checkout Requests
1. Navigate to `Checkout Requests`
2. Review pending requests
3. Approve or reject checkout requests

## Troubleshooting

### Image Upload Issues
If images aren't appearing after upload:
1. Ensure storage link is created: `php artisan storage:link`
2. Check permissions on storage directory
3. Verify uploads are going to `storage/app/public/items/` (not private directory)
4. Clear cache: `php artisan cache:clear`

### Database Connection Issues
1. Verify database credentials in `.env`
2. Ensure database service is running
3. Check for connectivity: `php artisan migrate:status`

## Contributing

1. Fork the repository
2. Create a new branch
3. Make your changes
4. Submit a pull request

## License

[Your License Information]
