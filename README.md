# **Restaurant Order Management System**  

## **📌 Project Overview**  
This is a **Restaurant Order Management System** built with PHP, MySQL, and Stripe for online payments. It allows customers to browse the menu, add items to a cart, and place orders with secure payment processing. Admins can manage orders, products, and customer interactions.  

### **✨ Key Features**  
✔ **User-Friendly Interface** – Browse menu categories, search products, and manage cart.  
✔ **Secure Checkout** – Integrated Stripe payment gateway.  
✔ **Order Tracking** – View order history and status.  
✔ **Admin Dashboard** – Manage products, orders, and customer messages.  
✔ **Responsive Design** – Works on desktop and mobile.  

## **🛠 Technologies Used**  
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap  
- **Backend:** PHP  
- **Database:** MySQL  
- **Payment Processing:** Stripe API  
- **Dependency Management:** Composer  

## **🚀 Installation Guide**  

### **Prerequisites**  
- Web server (Apache/Nginx)  
- PHP 7.0+  
- MySQL 5.6+  
- Composer (for PHP dependencies)  

### **Setup Instructions**  
1. **Clone the repository**  
   ```sh
   git clone https://github.com/fabricadecoduri/Restaurant-Order-Management-System.git
   cd Restaurant-Order-Management-System
   ```

2. **Set up the database**  
   - Import the provided SQL file (`db.sql`) into MySQL.  

3. **Configure database connection**  
   - Edit `partials/_dbconnect.php` with your MySQL credentials.  

4. **Install dependencies**  
   ```sh
   composer install
   ```

5. **Set up Stripe (for payments)**  
   - Get API keys from [Stripe Dashboard](https://dashboard.stripe.com/)  
   - Update in:  
     - `checkout.php`  
     - `success.php`  

6. **Run the application**  
   - Start your local server (e.g., XAMPP, WAMP, or `php -S localhost:8000`)  
   - Open `http://localhost:8000` in a browser.  

## **📂 Project Structure**  
```
├── admin/           # Admin panel
├── assets/          # CSS, JS, and images
├── partials/        # Reusable components (navbar, footer, DB connection)  
├── checkout.php     # Payment processing with Stripe
├── composer-setup.php # Composer setup
├── contact.php      # Customer support messaging
├── index.php        # Homepage with product listings
├── process_order.php # Handles order submission
├── search.php       # Product search functionality
├── success.php      # Order confirmation after payment
├── viewCart.php     # Cart products
├── viewOrder.php    # Order placements
├── viewPizza.php    # Product details
├── viewPizzaList.php # Category products
├── viewProfile.php  # Profile page
└── composer.json    # PHP dependencies
```

## **🔒 Security Notes**  
- **Password hashing** for user authentication.  
- **Input validation** to prevent SQL injection.  
- **Stripe’s secure payment processing** (PCI compliant).  

## **📜 License**  
MIT License - Free for personal and commercial use.  

## **🤝 Contributing**  
Contributions are welcome!  
1. Fork the repository  
2. Create a new branch (`git checkout -b feature/new-feature`)  
3. Commit changes (`git commit -m "Add new feature"`)  
4. Push to branch (`git push origin feature/new-feature`)  
5. Open a **Pull Request**  

## **📌 Future Improvements**  
- **Multi-payment options** (PayPal, Google Pay)  
- **Real-time order tracking** (WebSocket)  
- **User reviews & ratings**  
- **Delivery API integration** (Tazz/Glovo)  

---
**🎯 Ready to use?** Clone and deploy!  
**🍕 Happy Coding!**  

---
### **🔗 Useful Links**  
- [Stripe API Docs](https://stripe.com/docs)  
- [Bootstrap Documentation](https://getbootstrap.com/docs/)  
- [PHP Official Docs](https://www.php.net/docs.php)  

---
**⭐ If you find this project useful, give it a star!** ⭐  

---  
