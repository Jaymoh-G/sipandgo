# Email Configuration

This document contains the email configuration settings for Sip & Go.

## Mailtrap Sandbox (testing – emails go to Mailtrap, not real inboxes)

Use this when developing or testing so emails appear in [Mailtrap](https://mailtrap.io) instead of being sent to real addresses.

1. In Mailtrap: **Email Testing → Sandboxes → your sandbox → Integration → SMTP**
2. Copy **Host**, **Port**, **Username**, and **Password** from the Integration tab.
3. Put them in your `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=info@sip-and-go.co.ke
MAIL_FROM_NAME="Sip & Go"
```

Leave `MAIL_ENCRYPTION=` empty for port 2525. If your Mailtrap integration shows port 587, use `MAIL_PORT=587` and `MAIL_ENCRYPTION=tls`.

After changing `.env`, run: `php artisan config:clear`. Then place an order or use **“Resend confirmation email”** on the order success page; the email should appear in your Mailtrap sandbox.

## Production (Sip & Go SMTP)

For real delivery to customers:

```env
MAIL_MAILER=smtp
MAIL_HOST=sip-and-go.co.ke
MAIL_PORT=587
MAIL_USERNAME=info@sip-and-go.co.ke
MAIL_PASSWORD=Sip+254F
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@sip-and-go.co.ke
MAIL_FROM_NAME="Sip & Go"
```

**Note**: If port 587 doesn't work, try port `465` with `MAIL_ENCRYPTION=ssl` instead.

## Email Account Details

- **Email Address**: info@sip-and-go.co.ke
- **Password**: Sip+254F

## Notes

- The application uses SMTP to send order confirmation emails automatically when orders are placed
- The SMTP host is configured as `sip-and-go.co.ke` with port 587 (TLS encryption)
- If you encounter connection issues, try port `465` with SSL encryption instead

## Testing

After updating your `.env` file, clear the config cache:

```bash
php artisan config:clear
```

Then test by placing an order - the customer should receive an order confirmation email.
