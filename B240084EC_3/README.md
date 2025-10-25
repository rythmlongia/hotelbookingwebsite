# Hotel Booking System

A complete hotel booking system with separated frontend and backend architecture.

## Project Structure

```
├── assests/── images/        # Image assets
│ 
│
├── frontend/          # Frontend HTML pages and images
│   ├── index.html     # Main homepage
│   ├── login.html     # Login page
│   ├── signup.html    # Registration page
│   ├── checkin.html   # Booking form page
│   ├── details.html   # Static booking details page
│  
│
├── backend/           # Backend files (PHP)
│   ├── login.php      # Login processing
│   ├── signup.php     # Registration processing
│   ├── booking.php    # Booking processing
│   ├── details.php    # Dynamic booking details page
│   ├── logout.php     # Logout processing
│
│
├── mysql/── config
│               └── database.php # Database connection
└── index.php          # Root redirect to frontend
```

## Features

- User registration and login
- Hotel booking system
- Booking management
- Responsive design
- Session management
- Database integration

## Setup

1. Place the project in your web server directory (e.g., `htdocs`)
2. Create a MySQL database named `hotelbook`
3. Import the database schema
5. Access the application through your web server

## Usage

- Visit the root URL to access the homepage
- All frontend files are in the `frontend/` directory
- All backend processing files are in the `backend/` directory
- The system automatically redirects between frontend and backend as needed
