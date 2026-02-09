# Email Troubleshooting Guide

If emails are not being sent, follow these steps to diagnose and fix the issue:

## 1. Verify .env Configuration

Make sure your `.env` file has the correct email settings:

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

## 2. Clear Config Cache

After updating `.env`, clear the config cache:

```bash
php artisan config:clear
php artisan cache:clear
```

## 3. Check Laravel Logs

Check the Laravel log file for email errors:

```bash
tail -f storage/logs/laravel.log
```

Look for entries like:
- "Attempting to send order confirmation email"
- "Failed to send order confirmation email"
- SMTP connection errors

## 4. Test Email Configuration

You can test email sending using Laravel Tinker:

```bash
php artisan tinker
```

Then run:
```php
Mail::raw('Test email', function ($message) {
    $message->to('your-email@example.com')
            ->subject('Test Email');
});
```

## 5. Common SMTP Issues

### Port 587 Not Working
Try port `465` with SSL encryption:
```env
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

### Authentication Failed
- Verify username and password are correct
- Check if your email provider requires "Less secure app access" enabled
- Some providers require App Passwords instead of regular passwords

### Connection Timeout
- Verify `MAIL_HOST` is correct (might need `mail.sip-and-go.co.ke` or `smtp.sip-and-go.co.ke`)
- Check firewall settings
- Verify port is not blocked

## 6. Check Email Provider Settings

For cPanel/shared hosting:
- SMTP host is usually `mail.yourdomain.com` or `smtp.yourdomain.com`
- Port is typically `587` (TLS) or `465` (SSL)
- Username is usually the full email address
- Password is the email account password

## 7. Verify Email Sending in Code

The application logs email attempts. Check logs for:
- Order ID
- Email address
- Error messages

If you see "Skipping email send - invalid or guest email", the email address might be a fake guest email.

## 8. Alternative: Use Queue

If emails are slow or timing out, consider using queues:

```env
QUEUE_CONNECTION=database
```

Then run:
```bash
php artisan queue:work
```

## 9. Check PHP Mail Function

Verify PHP can send emails by checking `phpinfo()`:
```bash
php -i | grep -i mail
```

## 10. Contact Hosting Provider

If none of the above works, contact your hosting provider to:
- Verify SMTP settings
- Check if SMTP ports are open
- Confirm email account credentials
- Ask about any email sending restrictions
