<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Store Partnership Request</title>
    <style>
        /* Email-friendly CSS */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 40px 30px;
        }

        .alert-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .alert-box h2 {
            margin: 0 0 10px 0;
            color: #92400e;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .alert-box h2 i {
            margin-right: 10px;
        }

        .client-info {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #1e293b;
            font-weight: 500;
        }

        .highlight {
            color: #f59e0b;
            font-weight: 600;
        }

        .cta-section {
            text-align: center;
            margin: 40px 0 30px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .footer {
            background-color: #1e293b;
            color: #cbd5e1;
            padding: 30px;
            text-align: center;
            border-top: 4px solid #f59e0b;
        }

        .footer p {
            margin: 0 0 15px;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .footer-link {
            color: #f59e0b;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .timestamp {
            font-size: 12px;
            color: #94a3b8;
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .status-badge {
            display: inline-block;
            background-color: #fef3c7;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }

        .address-box {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            margin-top: 10px;
            font-style: normal;
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .content {
                padding: 20px 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>New Store Partnership Request</h1>
            <p>SHOP<span style="font-weight: 800;">NOW</span> Platform Notification</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert Box -->
            <div class="alert-box">
                <h2>
                    <span style="display: inline-block; margin-right: 10px;">🔔</span>
                    New Partnership Request Received
                    <span class="status-badge">PENDING REVIEW</span>
                </h2>
                <p style="margin: 0; color: #92400e;">
                    A new business has applied to join our platform. Review the details below and take appropriate action.
                </p>
            </div>

            <!-- Greeting -->
            <p style="font-size: 16px; margin-bottom: 25px;">
                Hello <strong>Admin Team</strong>,
            </p>

            <p style="font-size: 16px; margin-bottom: 30px;">
                A new store/restaurant has submitted a partnership request. Here are the complete details:
            </p>

            <!-- Client Information -->
            <div class="client-info">
                <h3 style="margin-top: 0; margin-bottom: 20px; color: #1e293b; font-size: 20px; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">
                    Store Application Details
                </h3>

                <div class="info-grid">
                    <!-- Left Column -->
                    <div>
                        <div class="info-item">
                            <div class="info-label">Client Name</div>
                            <div class="info-value highlight">{{ $client->name }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Shop/Store Name</div>
                            <div class="info-value">{{ $client->shop_name }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Contact Number</div>
                            <div class="info-value">
                                <a href="tel:{{ $client->contact }}" style="color: #f59e0b; text-decoration: none;">
                                    {{ $client->contact }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="info-item">
                            <div class="info-label">Email Address</div>
                            <div class="info-value">
                                <a href="mailto:{{ $client->email }}" style="color: #f59e0b; text-decoration: none;">
                                    {{ $client->email }}
                                </a>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Application Date</div>
                            <div class="info-value">{{ $client->created_at->format('F j, Y \a\t g:i A') }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Application ID</div>
                            <div class="info-value">#{{ str_pad($client->id, 6, '0', STR_PAD_LEFT) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="info-item" style="margin-top: 20px;">
                    <div class="info-label">Business Address</div>
                    <div class="address-box">
                        {{ $client->address }}
                    </div>
                </div>
            </div>

            <!-- Action Required -->
            <div style="background-color: #f0f9ff; border-radius: 8px; padding: 20px; margin: 30px 0; border-left: 4px solid #0ea5e9;">
                <h3 style="margin-top: 0; color: #0369a1; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">📋</span> Next Steps Required
                </h3>
                <ul style="margin: 15px 0; padding-left: 20px;">
                    <li style="margin-bottom: 8px;">Review the application details</li>
                    <li style="margin-bottom: 8px;">Verify business information</li>
                    <li style="margin-bottom: 8px;">Contact the client for verification</li>
                    <li>Approve or reject the application in the admin panel</li>
                </ul>
            </div>

            <!-- CTA Button -->
            <div class="cta-section">
                <a href="{{ url('/admin') }}" class="cta-button" target="_blank">
                    Review Application in Admin Panel
                </a>
                <p style="margin-top: 15px; font-size: 14px; color: #64748b;">
                    Click above to access the application directly in the admin dashboard
                </p>
            </div>

            <!-- Quick Actions -->
            <div style="text-align: center; margin: 30px 0;">
                <p style="font-size: 14px; color: #64748b; margin-bottom: 15px;">
                    <strong>Quick Actions:</strong>
                </p>
                <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                    <a href="mailto:{{ $client->email }}?subject=Regarding Your Partnership Application&body=Dear {{ $client->name }},%0D%0A%0D%0A"
                       style="display: inline-block; padding: 8px 16px; background-color: #f1f5f9; color: #475569; text-decoration: none; border-radius: 4px; font-size: 14px;">
                        📧 Reply via Email
                    </a>
                    <a href="tel:{{ $client->contact }}"
                       style="display: inline-block; padding: 8px 16px; background-color: #f1f5f9; color: #475569; text-decoration: none; border-radius: 4px; font-size: 14px;">
                        📞 Call Client
                    </a>
                </div>
            </div>
        </div>

        <!-- Timestamp -->
        <div class="timestamp">
            This notification was generated on {{ now()->format('F j, Y \a\t g:i A') }}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                <strong>SHOP<span style="font-weight: 800; color: #f59e0b;">NOW</span> Partner Platform</strong><br>
                Business Partnership Management System
            </p>
            <p style="font-size: 13px;">
                This is an automated notification. Please do not reply to this email.
            </p>
            <div class="footer-links">
                <a href="" class="footer-link">Admin Dashboard</a>
                <a href="" class="footer-link">View All Applications</a>
                <a href="" class="footer-link">Visit Website</a>
            </div>
            <p style="font-size: 12px; margin-top: 20px; color: #94a3b8;">
                © {{ date('Y') }} SHOPNOW Platform. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
