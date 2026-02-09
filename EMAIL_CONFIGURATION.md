# Email Configuration

This document contains the email configuration settings for Sip & Go.

## SMTP Settings

Add the following to your `.env` file:

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
