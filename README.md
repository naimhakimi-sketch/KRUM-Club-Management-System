# KRUM - Recreation Club Management System

<div align="center">

![KRUM Logo](./images/fevicon.png)

**A comprehensive web-based management system for the KRUM Recreation Club (Kelab Rekreasi Alam Semula Jadi)**

[Features](#features) • [Installation](#installation) • [Project Structure](#project-structure) • [Tech Stack](#tech-stack) • [Screenshots](#screenshots)

</div>

---

## 📋 Overview

KRUM (Kelab Rekreasi Alam Semula Jadi - Recreation Club) is a student-led recreation club dedicated to promoting love for nature and outdoor activities. This project is a comprehensive web-based management system that allows admin to manage club information, members, meetings, news, and activities.

Whether you're a club officer managing member information or a member checking latest club updates, KRUM provides an intuitive interface for all your recreation club needs.

---

## ✨ Features

### 👥 Member Management

- View all registered club members
- Member registration with validation
- Student ID tracking
- Position tracking within the club
- Member registration date history

### 📰 News Management

- Create and publish club news articles
- Update existing news posts
- Delete outdated content
- Read more functionality for detailed articles
- Admin panel for content management

### 📅 Meeting Management

- Schedule and announce club meetings
- View all upcoming meetings
- Meeting details including date, time, and location
- Admin controls for adding and editing meetings

### ℹ️ Club Information

- Dynamic about page managed by admin
- Club description and mission
- Editable contact information
- Professional presentation of club details

### 🔐 Authentication System

- Secure member login
- Separate admin authentication
- Password encryption using SHA1
- Two login types: Members and Committees

### 🎨 Admin Dashboard

- Centralized admin panel
- Easy content management
- User-friendly interface for all administrative tasks
- Full CRUD operations for all content

---

## 🛠️ Tech Stack

| Category              | Technology              |
| --------------------- | ----------------------- |
| **Backend**           | PHP 8.2+                |
| **Database**          | MySQL / MariaDB 10.4+   |
| **Frontend**          | HTML5, CSS3, JavaScript |
| **Framework/Library** | Bootstrap 5, jQuery     |
| **Server**            | XAMPP (Apache)          |

### Key Libraries & Tools

- **MySQLi** - Database connectivity
- **Bootstrap** - Responsive design
- **jQuery** - DOM manipulation
- **Font Awesome** - Icons
- **Fancy Box** - Image galleries

---

## 🚀 Installation

### Prerequisites

- XAMPP (or any Apache + MySQL + PHP setup)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser

### Step 1: Clone or Download the Project

```bash
# Clone the repository
git clone https://github.com/yourusername/KRUM.git

# Or download and extract to:
# C:\xampp\htdocs\Krum2
```

### Step 2: Database Setup

1. **Import the database:**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `krum_database`
   - Import the `krum_database (2).sql` file

2. **Verify database connection:**
   - Check `mysqli_connect_krum.php` for database credentials
   - Default settings:
     ```php
     DB_USER: 'root'
     DB_PASSWORD: ''
     DB_HOST: 'localhost'
     DB_NAME: 'krum_database'
     ```

### Step 3: Configure the Project

1. **Place project files in web root:**

   ```
   C:\xampp\htdocs\Krum2\
   ```

2. **Start XAMPP services:**
   - Start Apache
   - Start MySQL

3. **Access the application:**
   ```
   http://localhost/Krum2/
   ```

### Step 4: First Login

- **Member Login:** Use member credentials from the database
- **Admin Login:** Use committee/admin credentials from the database

---

## 📁 Project Structure

```
Krum2/
├── index.php                  # Homepage and login page
├── about.php                  # About page
├── members.php               # Members listing
├── news.php                  # News feed
├── meeting.php               # Meetings schedule
├── read-more.php             # Detailed news article
├── register.php              # Member registration
├── login_handle.php          # Login processing
├── mysqli_connect_krum.php   # Database connection
│
├── admin/                    # Admin panel
│   ├── admin.php            # Main admin dashboard
│   ├── admin-members.php    # Manage members
│   ├── admin-news.php       # Manage news
│   ├── admin-meeting.php    # Manage meetings
│   ├── admin-about.php      # Manage about page
│   ├── add-news.php         # Add new article
│   ├── add-meeting.php      # Add new meeting
│   ├── edit-*.php           # Edit content
│   ├── delete-*.php         # Delete content
│   └── delete_user.php      # Delete members
│
├── includes/                 # Shared templates
│   ├── header.html          # Page header
│   ├── footer.html          # Page footer
│   ├── admin-header.html    # Admin header
│   └── admin-footer.html    # Admin footer
│
├── css/                      # Stylesheets
│   ├── bootstrap.min.css
│   ├── style.css
│   ├── responsive.css
│   └── ...other CSS files
│
├── js/                       # JavaScript files
│   ├── jquery.min.js
│   ├── bootstrap.bundle.min.js
│   ├── custom.js
│   └── ...other JS files
│
├── images/                   # Project images and icons
├── fonts/                    # Custom fonts
├── README-ASSETS/            # Documentation images
└── krum_database (2).sql    # Database dump

```

---

## 📊 Database Schema

### Key Tables

**members**

- student_id (PK)
- name
- email (unique)
- password (SHA1 encrypted)
- position
- registration_date

**committees**

- committee_id (PK)
- email (unique)
- password (SHA1 encrypted)
- name
- position

**news**

- news_id (PK)
- title
- content
- author
- date_posted
- date_updated

**meetings**

- meeting_id (PK)
- title
- date
- time
- location
- description

**about**

- about_id (PK)
- title
- description

---

## 📸 Screenshots

### User Interface

<div align="center">

#### Login Page

<img src="./README-ASSETS/login-page.png" width="600" alt="Login Page">

#### Members Page

<img src="./README-ASSETS/members-page.png" width="600" alt="Members Page">

#### News Page

<img src="./README-ASSETS/news-page.png" width="600" alt="News Page">

#### About Page

<img src="./README-ASSETS/about-page.png" width="600" alt="About Page">

#### Meetings Page

<img src="./README-ASSETS/meeting-page.png" width="600" alt="Meetings Page">

</div>

### Admin Panel

<div align="center">

#### About Page Management

<img src="./README-ASSETS/about-page (admin).png" width="600" alt="Admin - About Management">

#### Members Management

<img src="./README-ASSETS/members-management-page(admin).png" width="600" alt="Admin - Members Management">

#### News Management

<img src="./README-ASSETS/news-management-page(admin).png" width="600" alt="Admin - News Management">

</div>

---

## 🔒 Security Features

- **Password Encryption:** SHA1 hashing for password storage
- **SQL Injection Prevention:** MySQLi prepared statements
- **Session Management:** PHP session handling for authentication
- **Form Validation:** Server-side validation for all inputs

---

## 🎯 Usage

### For Members

1. **Register** → Create a new member account
2. **Login** → Access member portal
3. **View Members** → See all club members
4. **Read News** → Check latest club updates
5. **View Meetings** → Check scheduled meetings
6. **About** → Learn about the club

### For Admins

1. **Login** → Access admin dashboard
2. **Manage Members** → Add, edit, delete members
3. **Manage News** → Create, edit, delete news articles
4. **Manage Meetings** → Schedule and manage meetings
5. **Manage About** → Update club information
6. **Manage Contact** → Update contact details

---

## 🔧 Configuration

### Database Connection

Edit `mysqli_connect_krum.php`:

```php
DEFINE ('DB_USER', 'your_db_user');
DEFINE ('DB_PASSWORD', 'your_password');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'krum_database');
```

### Adding Admin Users

Insert new admin credentials into the `committees` table:

```sql
INSERT INTO committees (email, password, name, position)
VALUES ('admin@krum.com', SHA1('password123'), 'Admin Name', 'Administrator');
```

---

## 🐛 Troubleshooting

| Issue                         | Solution                                                                                         |
| ----------------------------- | ------------------------------------------------------------------------------------------------ |
| **Database connection error** | Check `mysqli_connect_krum.php` - verify DB exists and credentials are correct                   |
| **Page not found (404)**      | Ensure project is in `C:\xampp\htdocs\Krum2` and access via `http://localhost/Krum2/`            |
| **Login fails**               | Verify credentials in database. Check that user exists in either `members` or `committees` table |
| **CSS/JS not loading**        | Clear browser cache, verify relative paths in includes                                           |
| **Images not displaying**     | Ensure image files exist in `images/` folder                                                     |

---

## 📝 Future Enhancements

- [ ] Email notifications for new meetings/news
- [ ] User profile management
- [ ] Event RSVP system
- [ ] Photo gallery from activities
- [ ] Attendance tracking
- [ ] Volunteer shifts management
- [ ] Mobile app version
- [ ] Two-factor authentication
- [ ] Activity feedback system

---

## 📄 License

This project is open source and available for educational and personal use. Modify and distribute as needed.

---

## 👨‍💻 Contributing

Contributions are welcome! Feel free to:

- Fork the repository
- Create feature branches
- Submit pull requests
- Report bugs and suggest improvements

---

## 📞 Contact & Support

For questions or support regarding KRUM Recreation Club, please reach out through:

- **Email:** krum@miit.edu (example)
- **GitHub Issues:** Create an issue for bug reports and feature requests

---

## 🙏 Acknowledgments

- Bootstrap framework for responsive design
- jQuery community for excellent JavaScript library
- Font Awesome for icons
- MariaDB/MySQL documentation

---

<div align="center">

**Made with ❤️ for KRUM Recreation Club**

⭐ If you found this project helpful, please consider giving it a star!

</div>
