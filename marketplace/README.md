# Lodin RTP Payment Extension for OpenCart 4

Accept instant payments via Lodin RTP (Request to Pay) on your OpenCart store.

## Features

- Instant payment link generation
- Real-time payment notifications via webhook
- Secure HMAC-SHA256 signature verification
- Support for multiple order statuses
- Easy configuration via admin panel

## Requirements

- OpenCart 4.0+
- PHP 8.1+
- cURL extension enabled
- Valid Lodin merchant account

## Installation

1. Download the extension package
2. Go to Extensions > Installer
3. Upload the .ocmod.zip file
4. Go to Extensions > Extensions > Payments
5. Find "Lodin RTP Payment" and click Install
6. Click Edit to configure your credentials

## Configuration

1. **Client ID**: Your Lodin merchant client ID
2. **Client Secret**: Your Lodin merchant secret key
3. **Status**: Enable/Disable the payment method
4. **Order Statuses**: Configure statuses for pending, completed, and failed payments
5. **Webhook URL**: Copy this URL and configure it in your Lodin merchant dashboard

## Webhook Configuration

The webhook URL is displayed in the admin configuration panel. Configure this URL in your Lodin merchant dashboard to receive payment notifications.

Format: `https://your-domain.com/index.php?route=extension/lodin/payment/lodin.callback`

## Support

For support, please contact: support@lodinpay.com

## License

Proprietary - © 2026 Lodin
