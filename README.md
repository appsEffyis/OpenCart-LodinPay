# LodinPay Payment Gateway for OpenCart

[![OpenCart](https://img.shields.io/badge/OpenCart-4.0+-blue.svg)](https://www.opencart.com/)
[![PHP](https://img.shields.io/badge/PHP-8.1+-purple.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Version](https://img.shields.io/badge/Version-1.0.0-orange.svg)](https://github.com/lodinpay/opencart-extension)

Accept instant payments with LodinPay's Request to Pay (RTP) technology on your OpenCart store.

---

## 🚀 Features

- ✅ **Instant Payment Links** - Generate secure payment URLs automatically
- ✅ **Real-Time Notifications** - Webhook integration for instant order updates
- ✅ **Bank-Grade Security** - HMAC-SHA256 signature verification
- ✅ **Easy Integration** - Install and configure in under 5 minutes
- ✅ **Sandbox Testing** - Test before going live
- ✅ **Multi-Currency Support** - Accept payments in different currencies
- ✅ **Detailed Logging** - Complete transaction history

---

## 📋 Requirements

- OpenCart 4.0.0.0 or higher
- PHP 8.1, 8.2, or 8.3
- MySQL 5.7+ or MySQL 8.0+
- SSL certificate (HTTPS required)
- Valid LodinPay merchant account

### Tested Versions
- ✅ OpenCart 4.0.0.0 - 4.0.2.3
- ✅ PHP 8.1, 8.2, 8.3
- ✅ MySQL 5.7, 8.0, 8.1

---

## 📦 Installation

### Method 1: Automatic Installation (Recommended)

1. Download the latest release from [Releases](https://github.com/lodinpay/opencart-extension/releases)
2. Go to **Extensions → Installer** in OpenCart admin
3. Upload the ZIP file
4. Go to **Extensions → Extensions → Payments**
5. Find **LodinPay** and click Install
6. Click Edit to configure

### Method 2: Manual Installation

```bash
# Clone the repository
git clone https://github.com/lodinpay/opencart-extension.git

# Copy extension files to OpenCart
cp -r opencart_files/extension/lodin /path/to/opencart/extension/

# Set permissions
chmod -R 755 /path/to/opencart/extension/lodin
```

---

## ⚙️ Configuration

1. **Get Your Credentials**
   - Sign up at [https://lodinpay.com](https://lodinpay.com)
   - Get your Client ID and Client Secret from the merchant dashboard

2. **Configure Extension**
   - Go to **Extensions → Extensions → Payments → LodinPay → Edit**
   - Enter your Client ID
   - Enter your Client Secret
   - Select Environment (Sandbox for testing, Production for live)
   - Set your preferred order statuses
   - Enable the payment method
   - Save

3. **Setup Webhook**
   - Copy the webhook URL from the extension settings
   - Add it to your LodinPay merchant dashboard
   - Test the webhook connection

4. **Test**
   - Make a test order in sandbox mode
   - Verify payment processing
   - Check order status updates
   - Go live!

---

## 🎯 How It Works

### For Customers
1. Add products to cart
2. Proceed to checkout
3. Select LodinPay as payment method
4. Redirected to secure LodinPay payment page
5. Complete payment via bank transfer
6. Instant confirmation and return to store

### For Merchants
1. Orders created automatically
2. Webhook updates order status in real-time
3. View transaction details in order history
4. Process refunds if needed

---

## 📖 Documentation

- [Installation Guide](docs/INSTALLATION.md)
- [Configuration Guide](docs/CONFIGURATION.md)
- [Webhook Setup](docs/WEBHOOK.md)
- [Troubleshooting](docs/TROUBLESHOOTING.md)
- [API Documentation](https://docs.lodinpay.com)

---

## 🔒 Security

- **HMAC-SHA256 Signatures** - Every webhook is cryptographically signed
- **SSL/TLS Encryption** - All data transmitted securely
- **PCI-DSS Compliance** - No card data stored on your server
- **Regular Security Updates** - Continuous monitoring and improvements

---

## 🌍 Compatibility

### OpenCart Versions
✅ 4.0.0.0, 4.0.1.0, 4.0.1.1, 4.0.2.0, 4.0.2.1, 4.0.2.2, 4.0.2.3, 4.1.0.0

### PHP Versions
✅ PHP 8.1, 8.2, 8.3

### Database
✅ MySQL 5.7+, MySQL 8.0+, MariaDB 10.3+

### Tested With
✅ Default OpenCart theme
✅ Journal 3 theme
✅ Most popular third-party themes

---

## 🛠️ Development

### Project Structure

```
opencart-extension/
├── opencart_files/
│   └── extension/
│       └── lodin/
│           ├── install.json
│           ├── install.xml
│           ├── admin/
│           │   ├── controller/
│           │   ├── language/
│           │   └── view/
│           └── catalog/
│               ├── controller/
│               ├── language/
│               ├── model/
│               └── view/
├── docs/
├── tests/
└── README.md
```

### Running Tests

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run linter
composer lint
```

---

## 🤝 Contributing

Contributions are welcome! Please read our [Contributing Guide](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for a list of changes.

### Version 1.0.0 (2024-01-15)
- Initial release
- Payment link generation
- Webhook integration
- Order status management
- Admin configuration interface

---

## 📞 Support

- **Email**: support@lodinpay.com
- **Documentation**: https://docs.lodinpay.com
- **Issues**: [GitHub Issues](https://github.com/lodinpay/opencart-extension/issues)
- **Response Time**: Within 24 hours

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
