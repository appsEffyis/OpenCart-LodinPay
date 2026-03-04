# LodinPay Payment Gateway for OpenCart

Accept instant payments with LodinPay's Request to Pay (RTP) technology.

## Features

- ✅ Instant payment link generation
- ✅ Real-time webhook notifications
- ✅ Secure HMAC-SHA256 signatures
- ✅ Multiple order status support
- ✅ Easy admin configuration
- ✅ Sandbox and production environments
- ✅ Detailed transaction logging

## Requirements

- OpenCart 4.0.0.0 - 4.1.0.0+ (All 4.x versions)
- PHP 8.1, 8.2, or 8.3
- MySQL 5.7+ or MySQL 8.0+
- SSL certificate (HTTPS required)
- Valid LodinPay merchant account

### Tested Versions
- ✅ OpenCart 4.0.0.0, 4.0.1.0, 4.0.1.1
- ✅ OpenCart 4.0.2.0, 4.0.2.1, 4.0.2.2, 4.0.2.3
- ✅ OpenCart 4.1.0.0 (when available)
- ✅ PHP 8.1, 8.2, 8.3
- ✅ MySQL 5.7, 8.0, 8.1

## Installation

### Automatic Installation (Recommended)

1. Download the extension ZIP file
2. Go to **Extensions → Installer** in OpenCart admin
3. Upload the ZIP file
4. Go to **Extensions → Extensions → Payments**
5. Find **LodinPay** and click Install
6. Click Edit to configure

### Manual Installation

1. Extract the ZIP file
2. Upload contents to your OpenCart root directory
3. Go to **Extensions → Extensions → Payments**
4. Find **LodinPay** and click Install
5. Click Edit to configure

## Configuration

1. **Get LodinPay Credentials**
   - Sign up at https://lodinpay.com
   - Get your Client ID and Client Secret

2. **Configure Extension**
   - Enter Client ID
   - Enter Client Secret
   - Select Environment (Sandbox for testing, Production for live)
   - Set order statuses
   - Enable the payment method

3. **Setup Webhook**
   - Copy the webhook URL shown in settings
   - Add it to your LodinPay merchant dashboard
   - Test the webhook connection

## Usage

### For Customers
1. Add products to cart
2. Proceed to checkout
3. Select LodinPay as payment method
4. Complete payment on secure LodinPay page
5. Return to store with order confirmation

### For Merchants
1. Orders are created automatically
2. Webhook updates order status in real-time
3. View transaction details in order history
4. Process refunds if needed

## Webhook URL

Your webhook URL will be:
```
https://yourstore.com/index.php?route=extension/lodin/payment/lodin.callback
```

Configure this URL in your LodinPay merchant dashboard.

## Order Statuses

- **Pending**: Payment initiated, waiting for completion
- **Processing**: Payment received, order being processed
- **Complete**: Payment confirmed, order fulfilled
- **Failed**: Payment failed or cancelled

## Testing

1. Set Environment to "Sandbox"
2. Use test credentials from LodinPay
3. Make a test order
4. Verify webhook notifications
5. Check order status updates

## Troubleshooting

### Payment not processing
- Check Client ID and Secret are correct
- Verify webhook URL is configured
- Check SSL certificate is valid
- Review error logs

### Webhook not working
- Ensure webhook URL is correct
- Check firewall settings
- Verify HTTPS is enabled
- Test webhook from LodinPay dashboard

### Order status not updating
- Check webhook is receiving notifications
- Verify order status mappings
- Review transaction logs
- Check for PHP errors

## Support

- **Email**: support@lodinpay.com
- **Documentation**: https://docs.lodinpay.com
- **Response Time**: Within 24 hours

## Changelog

### Version 1.0.0 (2024-01-15)
- Initial release
- Payment link generation
- Webhook integration
- Order status management
- Admin configuration interface

## License

MIT License - See LICENSE file for details

## Credits

Developed by LodinPay Team
- Website: https://lodinpay.com
- Email: support@lodinpay.com

## Screenshots

1. Admin Configuration
2. Payment Method Selection
3. LodinPay Payment Page
4. Order Management
5. Transaction Logs

See the screenshots folder for examples.

---

**Thank you for using LodinPay!**
