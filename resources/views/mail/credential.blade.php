<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Store Credentials - SHOPNOW</title>
    <style>
        /* Email-friendly CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8fafc;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 50px 30px;
            text-align: center;
            position: relative;
        }

        .security-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .security-badge i {
            margin-right: 8px;
        }

        .header-icon {
            width: 100px;
            height: 100px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .header p {
            font-size: 18px;
            opacity: 0.9;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Content */
        .content {
            padding: 50px 40px;
        }

        .greeting {
            font-size: 20px;
            margin-bottom: 30px;
            color: #1f2937;
            line-height: 1.8;
        }

        .greeting strong {
            color: #10b981;
        }

        /* Store Info Card */
        .store-card {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-radius: 12px;
            padding: 35px;
            margin-bottom: 40px;
            border: 2px solid #10b981;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background-color: #10b981;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
        }

        .card-title {
            font-size: 26px;
            color: #065f46;
            margin-bottom: 10px;
            text-align: center;
            font-weight: 700;
        }

        .card-subtitle {
            color: #10b981;
            font-size: 18px;
            text-align: center;
            margin-bottom: 25px;
        }

        /* Credentials Card */
        .credentials-card {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 35px;
            margin-bottom: 40px;
            border: 2px solid #3b82f6;
            position: relative;
        }

        .credentials-title {
            font-size: 24px;
            color: #1e40af;
            margin-bottom: 30px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .credentials-title i {
            margin-right: 12px;
            color: #3b82f6;
        }

        .credential-row {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px dashed #d1d5db;
        }

        .credential-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .credential-icon {
            width: 50px;
            height: 50px;
            background-color: #dbeafe;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: #3b82f6;
            font-size: 22px;
            flex-shrink: 0;
        }

        .credential-details {
            flex: 1;
        }

        .credential-label {
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .credential-value {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            word-break: break-all;
        }

        /* Password Display */
        .password-display {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 3px dashed #f59e0b;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin-top: 15px;
            position: relative;
        }

        .password-label {
            font-size: 14px;
            color: #92400e;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .password-value {
            font-family: 'Courier New', monospace;
            font-size: 28px;
            font-weight: 700;
            color: #92400e;
            letter-spacing: 4px;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            border: 2px solid #f59e0b;
            margin: 10px 0;
        }

        .password-note {
            font-size: 14px;
            color: #92400e;
            margin-top: 15px;
            font-style: italic;
        }

        /* Security Warning */
        .security-warning {
            background-color: #fef2f2;
            border-radius: 10px;
            padding: 25px;
            margin: 40px 0;
            border-left: 5px solid #ef4444;
        }

        .warning-title {
            font-size: 20px;
            color: #dc2626;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .warning-title i {
            margin-right: 12px;
            color: #ef4444;
        }

        .warning-list {
            list-style: none;
            padding-left: 10px;
        }

        .warning-list li {
            margin-bottom: 12px;
            color: #7f1d1d;
            padding-left: 25px;
            position: relative;
        }

        .warning-list li:before {
            content: "⚠️";
            position: absolute;
            left: 0;
        }

        /* Action Steps */
        .action-steps {
            margin: 40px 0;
        }

        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            padding: 20px;
            background-color: #f0f9ff;
            border-radius: 10px;
            border: 1px solid #e0f2fe;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .step-description {
            font-size: 15px;
            color: #475569;
        }

        /* Login Button */
        .login-section {
            text-align: center;
            margin: 50px 0;
            padding: 40px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
        }

        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            padding: 18px 50px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }

        .login-url {
            display: block;
            margin-top: 20px;
            color: #64748b;
            font-size: 16px;
            word-break: break-all;
        }

        .login-url a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background-color: #1e293b;
            color: #cbd5e1;
            padding: 50px 40px;
            text-align: center;
        }

        .footer-logo {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .footer-logo span {
            color: #10b981;
        }

        .platform-tagline {
            font-size: 16px;
            opacity: 0.8;
            margin-bottom: 30px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
            margin: 30px 0;
            padding: 30px 0;
            border-top: 1px solid #334155;
            border-bottom: 1px solid #334155;
        }

        .footer-link {
            color: #10b981;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .contact-details {
            font-size: 14px;
            color: #94a3b8;
            line-height: 1.8;
        }

        .disclaimer {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #334155;
        }

        /* Auto-generated Badge */
        .auto-generated-badge {
            display: inline-block;
            background-color: #fef3c7;
            color: #92400e;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 15px;
            border: 1px solid #f59e0b;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }

            .header {
                padding: 40px 20px;
            }

            .header h1 {
                font-size: 26px;
            }

            .store-card, .credentials-card {
                padding: 25px 20px;
            }

            .credential-row {
                flex-direction: column;
                text-align: center;
            }

            .credential-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .password-value {
                font-size: 24px;
                letter-spacing: 3px;
                padding: 12px;
            }

            .footer-links {
                flex-direction: column;
                gap: 15px;
            }

            .login-button {
                padding: 16px 30px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="security-badge">
                <span>🔐 SECURE</span>
            </div>

            <div class="header-icon">
                <span style="font-size: 48px;">🔑</span>
            </div>

            <h1>Your Store Access Credentials</h1>
            <p>Login details for your approved store on SHOPNOW Platform</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <p class="greeting">
                Dear <strong>{{ $client->name }}</strong>,<br><br>
                As part of your store approval process, here are your login credentials to access your store dashboard.
                Your store <strong>"{{ $client->shop_name }}"</strong> is now active and ready for business!
            </p>

            <!-- Store Information -->
            <div class="store-card">
                <div class="card-icon">🏪</div>
                <h2 class="card-title">{{ $client->shop_name }}</h2>
                <p class="card-subtitle">Approved Store on SHOPNOW Platform</p>

                <div style="text-align: center; margin-top: 20px;">
                    <p style="color: #065f46; margin-bottom: 8px;">
                        <strong>Store Owner:</strong> {{ $client->name }}
                    </p>
                    <p style="color: #065f46; margin-bottom: 8px;">
                        <strong>Contact:</strong> {{ $client->contact }}
                    </p>
                    <p style="color: #065f46;">
                        <strong>Address:</strong> {{ $client->address }}
                    </p>
                </div>
            </div>

            <!-- Credentials -->
            <div class="credentials-card">
                <h3 class="credentials-title">
                    <span style="display: inline-block; margin-right: 10px;">🔐</span>
                    Account Login Details
                </h3>

                <!-- Email -->
                <div class="credential-row">
                    <div class="credential-icon">
                        <span>📧</span>
                    </div>
                    <div class="credential-details">
                        <div class="credential-label">Login Email Address</div>
                        <div class="credential-value">{{ $client->email }}</div>
                    </div>
                </div>

                <!-- Password -->
                <div class="credential-row">
                    <div class="credential-icon">
                        <span>🔑</span>
                    </div>
                    <div class="credential-details">
                        <div class="credential-label">
                            Auto-generated Password
                            <span class="auto-generated-badge">Auto-generated</span>
                        </div>

                        <div class="password-display">
                            <div class="password-label">Your Temporary Password</div>
                            <div class="password-value">{{ $password }}</div>
                            <div class="password-note">
                                This password was automatically generated for your account security
                            </div>
                        </div>

                        <div style="margin-top: 15px; color: #6b7280; font-size: 14px;">
                            <strong>Important:</strong> This password was generated by our system. Please change it immediately after your first login.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Warning -->
            <div class="security-warning">
                <h4 class="warning-title">
                    <span style="display: inline-block; margin-right: 10px;">⚠️</span>
                    Security Alert - Important Instructions
                </h4>
                <ul class="warning-list">
                    <li>This password is TEMPORARY and should be changed immediately</li>
                    <li>Do not share these credentials with anyone</li>
                    <li>Our team will NEVER ask for your password</li>
                    <li>Use a strong, unique password when changing</li>
                    <li>Enable two-factor authentication if available</li>
                </ul>
            </div>

            <!-- Action Steps -->
            <div class="action-steps">
                <h3 style="color: #1e293b; margin-bottom: 25px; text-align: center; font-size: 22px;">
                    <span style="display: inline-block; margin-right: 10px;">🚀</span>
                    Ready to Start? Follow These Steps
                </h3>

                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4 class="step-title">Login to Your Dashboard</h4>
                        <p class="step-description">Use the email and password above to login to your store management dashboard</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4 class="step-title">Change Your Password Immediately</h4>
                        <p class="step-description">Go to Account Settings → Change Password to set a new, secure password</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4 class="step-title">Complete Store Setup</h4>
                        <p class="step-description">Upload your products, set up payment methods, and configure shipping options</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4 class="step-title">Start Accepting Orders</h4>
                        <p class="step-description">Your store is now live! Begin selling to thousands of customers</p>
                    </div>
                </div>
            </div>

            <!-- Login Section -->
            <div class="login-section">
                <a href="{{ url('/client') }}" class="login-button" target="_blank">
                    🚀 Login to Dashboard Now
                </a>
                 <div class="login-url">
                    Login URL: <a href="{{ url('/client') }}">{{ url('/client') }}</a>
                </div>
            </div>

            <!-- Support Information -->
            <div style="text-align: center; padding: 30px; background-color: #f1f5f9; border-radius: 10px; margin-top: 40px;">
                <h4 style="color: #475569; margin-bottom: 15px;">
                    <span style="display: inline-block; margin-right: 10px;">💼</span>
                    Need Help? We're Here For You
                </h4>
                <div style="display: flex; justify-content: center; gap: 25px; flex-wrap: wrap; margin-top: 20px;">
                    <div style="color: #475569;">
                        <strong>📧 Support Email:</strong><br>support@shopnow.com
                    </div>
                    <div style="color: #475569;">
                        <strong>📞 Support Phone:</strong><br>+1 (800) 123-4567
                    </div>
                    <div style="color: #475569;">
                        <strong>🕐 Business Hours:</strong><br>Mon-Fri, 9AM-6PM
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">SHOP<span>NOW</span></div>
            <p class="platform-tagline">Premium Business Partnership Platform</p>

            <div class="footer-links">
                <a href="" class="footer-link">Visit Our Website</a>
                <a href="" class="footer-link">Partner Login</a>
                <a href="" class="footer-link">Help & Support</a>
                <a href="" class="footer-link">FAQs</a>
                <a href="" class="footer-link">Contact Us</a>
            </div>

            <div class="contact-details">
                <p>📍 {{ $client->address }}</p>
                <p>📧 support@shopnow.com | 📞 +1 (800) 123-4567</p>
            </div>

            <div class="disclaimer">
                <p>
                    <strong>Security Notice:</strong> This email contains sensitive login information. Please keep it secure.<br>
                    This is an automated message from SHOPNOW Partner Platform. Do not reply to this email.<br>
                    © {{ date('Y') }} SHOPNOW Platform. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
