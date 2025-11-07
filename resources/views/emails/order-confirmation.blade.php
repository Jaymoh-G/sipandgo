<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - {{ $order->order_number }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">Sip & Go</h1>
        <p style="color: white; margin: 10px 0 0 0; font-size: 16px;">Order Confirmation</p>
    </div>

    <div style="background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <p style="font-size: 16px; margin-bottom: 20px;">Hello {{ $order->customer->first_name }},</p>

        <p style="font-size: 16px; margin-bottom: 20px;">
            Thank you for your order! We've received your order and will begin processing it shortly.
        </p>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
            <h2 style="color: #1f2937; margin-top: 0; font-size: 20px; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">
                Order Details
            </h2>

            <div style="margin-bottom: 15px;">
                <strong style="color: #6b7280;">Order Number:</strong>
                <span style="color: #1f2937; font-weight: bold;">{{ $order->order_number }}</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #6b7280;">Order Date:</strong>
                <span style="color: #1f2937;">{{ $order->created_at->format('F j, Y g:i A') }}</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #6b7280;">Status:</strong>
                <span style="color: #1f2937; text-transform: capitalize;">{{ $order->status }}</span>
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
            <h2 style="color: #1f2937; margin-top: 0; font-size: 20px; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">
                Order Items
            </h2>

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="text-align: left; padding: 10px; color: #6b7280; font-weight: 600;">Product</th>
                        <th style="text-align: center; padding: 10px; color: #6b7280; font-weight: 600;">Quantity</th>
                        <th style="text-align: right; padding: 10px; color: #6b7280; font-weight: 600;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 10px; color: #1f2937;">{{ $item->product_name }}</td>
                        <td style="text-align: center; padding: 10px; color: #1f2937;">{{ $item->quantity }}</td>
                        <td style="text-align: right; padding: 10px; color: #1f2937;">${{ number_format($item->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
            <h2 style="color: #1f2937; margin-top: 0; font-size: 20px; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">
                Order Summary
            </h2>

            <table style="width: 100%;">
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Subtotal:</td>
                    <td style="text-align: right; padding: 8px 0; color: #1f2937;">${{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Tax:</td>
                    <td style="text-align: right; padding: 8px 0; color: #1f2937;">${{ number_format($order->tax_amount, 2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Shipping:</td>
                    <td style="text-align: right; padding: 8px 0; color: #1f2937;">${{ number_format($order->shipping_amount, 2) }}</td>
                </tr>
                <tr style="border-top: 2px solid #e5e7eb; margin-top: 10px;">
                    <td style="padding: 12px 0; font-weight: bold; font-size: 18px; color: #1f2937;">Total:</td>
                    <td style="text-align: right; padding: 12px 0; font-weight: bold; font-size: 18px; color: #f59e0b;">${{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </table>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
            <h2 style="color: #1f2937; margin-top: 0; font-size: 20px; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">
                Shipping Address
            </h2>

            <p style="color: #1f2937; margin: 0; line-height: 1.8;">
                {{ $order->shipping_address['name'] }}<br>
                {{ $order->shipping_address['address_line_1'] }}<br>
                @if($order->shipping_address['address_line_2'])
                    {{ $order->shipping_address['address_line_2'] }}<br>
                @endif
                {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{ $order->shipping_address['postal_code'] }}<br>
                {{ $order->shipping_address['country'] }}
            </p>
        </div>

        <div style="background: #fef3c7; border: 1px solid #fbbf24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <p style="margin: 0; color: #92400e; font-size: 14px;">
                <strong>⚠️ Age Verification Required:</strong> You must be 21+ to receive alcohol products.
                Valid ID will be required upon delivery.
            </p>
        </div>

        <p style="font-size: 16px; margin-bottom: 20px;">
            We'll send you another email when your order ships. If you have any questions,
            please contact us at <a href="mailto:support@sipandgo.com" style="color: #f59e0b;">support@sipandgo.com</a>.
        </p>

        <p style="font-size: 16px; margin-bottom: 0;">
            Thank you for shopping with Sip & Go!
        </p>
    </div>

    <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px;">
        <p style="margin: 0;">© {{ date('Y') }} Sip & Go. All rights reserved.</p>
        <p style="margin: 5px 0 0 0;">Must be 21+ to purchase alcohol products.</p>
    </div>
</body>
</html>

