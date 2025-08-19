# 🎨 Art-Express

**Art-Express** is a comprehensive art marketplace and auction platform that connects artists with art enthusiasts. Built with Laravel 11, it provides a complete ecosystem for buying, selling, and auctioning artwork with advanced features like real-time chat, AI assistance, and secure payment processing.

![Art-Express Logo](https://img.shields.io/badge/Art--Express-Platform-blue?style=for-the-badge&logo=artstation)
![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-purple?style=for-the-badge&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

## ✨ Features

### 🎭 **Multi-Role System**
- **Admin Panel**: Complete platform management, user control, and analytics
- **Artist Dashboard**: Portfolio management, product listing, and sales tracking
- **User Portal**: Art discovery, purchasing, and auction participation

### 🛍️ **Art Marketplace**
- Browse and purchase artwork from talented artists
- Advanced search and filtering by categories
- Secure payment processing with Stripe
- Order management and tracking

### 🏛️ **Auction System**
- Create and participate in art auctions
- Real-time bidding with automatic status updates
- Auction registration and participation management
- Refund system for auction participants

### 📝 **Content Management**
- Artist blogs and articles
- Comment and like system
- AI-powered category explanations (ChatGPT integration)
- Rich media support with image optimization

### 💬 **Communication**
- Real-time messaging system
- Artist-customer chat functionality
- Notification system for orders and updates

### 🎨 **Artist Features**
- Portfolio showcase with image galleries
- Custom art request system
- Sales analytics and performance tracking
- Social media integration

### 🔐 **Security & Authentication**
- Email verification system
- Role-based access control (RBAC)
- Permission management
- Secure password reset

## 🚀 Technology Stack

### **Backend**
- **Laravel 11** - PHP framework
- **MySQL/PostgreSQL** - Database
- **Redis** - Caching and sessions
- **Laravel Sanctum** - API authentication

### **Frontend**
- **Blade Templates** - Server-side rendering
- **Bootstrap 5** - UI framework
- **Vite** - Build tool and dev server

### **Key Packages**
- **Spatie Laravel Permission** - Role and permission management
- **Laravel DataTables** - Advanced data tables
- **Intervention Image** - Image manipulation
- **Cloudinary Laravel** - Cloud image storage
- **Munafio Chatify** - Real-time chat system
- **Stripe PHP** - Payment processing
- **Pusher** - Real-time notifications

## 📋 Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18+ and npm
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Web Server**: Apache/Nginx
- **Redis**: For caching and sessions

## 🛠️ Installation

### 1. **Clone the Repository**
```bash
git clone https://github.com/yourusername/art-express.git
cd art-express
```

### 2. **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. **Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. **Configure Environment**
Edit `.env` file with your database and service credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=art_express
DB_USERNAME=your_username
DB_PASSWORD=your_password

CLOUDINARY_URL=your_cloudinary_url
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
PUSHER_APP_ID=your_pusher_id
PUSHER_APP_KEY=your_pusher_key
PUSHER_APP_SECRET=your_pusher_secret
```

### 5. **Database Setup**
```bash
# Run migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

### 6. **Storage Setup**
```bash
# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 775 storage bootstrap/cache
```

### 7. **Build Assets**
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. **Start Development Server**
```bash
# Using Laravel's built-in server
php artisan serve

# Or use the custom dev script
composer run dev
```

## 🏗️ Project Structure

```
art-express/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Services/            # Business logic services
│   ├── Notifications/       # Email notifications
│   ├── Events/              # Event classes
│   ├── Jobs/                # Queue jobs
│   └── Helpers/             # Helper functions
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/            # Database seeders
│   └── factories/          # Model factories
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php             # Web routes
│   └── chatify/            # Chat routes
├── public/                 # Public assets
├── storage/                # File storage
└── tests/                  # Test files
```

## 🔑 Key Models & Relationships

### **User Management**
- `User` - Core user model with role-based access
- `Profile` - Extended user profile information
- `Role` & `Permission` - RBAC system

### **Art & Products**
- `Products` - Artwork listings
- `Categories` & `SubCategories` - Product classification
- `Images` - Product and portfolio images
- `Blogs` - Artist articles and content

### **E-commerce**
- `Order` & `OrderItem` - Purchase management
- `Checkout` - Payment processing
- `Comment` & `Like` - Social interactions

### **Auction System**
- `Auction` - Auction events
- `AuctionItem` - Items for auction
- `Registration` - Participant management

## 🚀 Usage

### **For Artists**
1. Register and verify your account
2. Complete your profile and portfolio
3. Add artwork with descriptions and pricing
4. Create blogs to engage with the community
5. Participate in auctions and custom requests

### **For Art Enthusiasts**
1. Browse artwork by category or artist
2. Purchase artwork through secure checkout
3. Participate in auctions
4. Connect with artists through messaging
5. Follow your favorite artists and blogs

### **For Administrators**
1. Manage users and roles
2. Monitor platform statistics
3. Oversee auctions and transactions
4. Manage categories and content
5. Handle support and disputes

## 🔧 Development

### **Custom Development Script**
```bash
# Run all development services concurrently
composer run dev
```
This command runs:
- Laravel development server
- Queue worker
- Log monitoring
- Vite dev server

### **Code Quality**
```bash
# Run PHP code style fixer
./vendor/bin/pint

# Run tests
php artisan test
```

### **Database**
```bash
# Create new migration
php artisan make:migration create_table_name

# Rollback migrations
php artisan migrate:rollback

# Refresh database
php artisan migrate:fresh --seed
```

## 📱 API Endpoints

The application provides RESTful API endpoints for:
- User authentication and management
- Product catalog and search
- Order processing
- Auction management
- Messaging system

## 🔒 Security Features

- **CSRF Protection** - Built-in Laravel security
- **SQL Injection Prevention** - Eloquent ORM
- **XSS Protection** - Blade template escaping
- **Rate Limiting** - API and form submission protection
- **File Upload Security** - Image validation and processing

## 🚀 Deployment

### **Production Checklist**
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Configure production database
- [ ] Set up SSL certificates
- [ ] Configure web server (Apache/Nginx)
- [ ] Set up Redis for caching
- [ ] Configure file storage (Cloudinary/S3)
- [ ] Set up monitoring and logging

### **Recommended Hosting**
- **Shared Hosting**: Hostinger, A2 Hosting
- **VPS**: DigitalOcean, Linode, Vultr
- **Cloud**: AWS, Google Cloud, Azure
- **Managed**: Laravel Forge, Ploi.io

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Check the code comments and Laravel docs
- **Issues**: Report bugs via GitHub Issues
- **Discussions**: Use GitHub Discussions for questions
- **Email**: Contact the development team

## 🙏 Acknowledgments

- **Laravel Team** - For the amazing framework
- **Spatie** - For the permission package
- **Munafio** - For the chat system
- **All Contributors** - For making this project better

---

**Made with ❤️ by the Art-Express Team**

*Connect with artists, discover masterpieces, and build your art collection today!*
