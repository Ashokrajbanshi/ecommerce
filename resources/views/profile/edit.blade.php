<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Account Settings') }} • {{ config('app.name', 'Store') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
            --border: #e2e8f0;
            --radius: 12px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.1);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: white;
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 2rem 0;
            z-index: 50;
            transition: var(--transition);
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: var(--transition);
        }

        /* Navigation */
        .nav-logo {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1.5rem;
        }

        .nav-logo h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem 2rem;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .header-left h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .header-left p {
            color: var(--secondary);
            font-size: 0.95rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
        }

        .card-header i {
            color: var(--primary);
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
        }

        .form-control.is-valid {
            border-color: var(--success);
        }

        .form-hint {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .form-error {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.875rem 1.75rem;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn i {
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary {
            background: white;
            color: var(--dark);
            border: 1.5px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--light);
            border-color: var(--primary);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.2);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Grid */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        /* Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-icon.orders { background: #e0f2fe; color: #0369a1; }
        .stat-icon.wishlist { background: #fef3c7; color: #d97706; }
        .stat-icon.reviews { background: #dbeafe; color: var(--primary); }
        .stat-icon.member { background: #dcfce7; color: #16a34a; }

        .stat-info h4 {
            font-size: 0.9rem;
            color: var(--secondary);
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .stat-info p {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* Danger Zone */
        .danger-zone {
            border: 1.5px solid #fee2e2;
            background: #fef2f2;
            border-radius: var(--radius);
            padding: 1.5rem;
        }

        .danger-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .danger-header i {
            color: var(--danger);
            font-size: 1.25rem;
        }

        .danger-header h4 {
            color: var(--danger);
            font-weight: 600;
        }

        .danger-content p {
            color: #7f1d1d;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            transform: translateX(120%);
            transition: var(--transition);
            max-width: 400px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
        }

        .toast-icon.success { background: var(--success); }
        .toast-icon.error { background: var(--danger); }
        .toast-icon.warning { background: var(--warning); }

        .toast-content p {
            font-weight: 500;
            color: var(--dark);
        }

        .toast-close {
            margin-left: auto;
            background: none;
            border: none;
            color: var(--secondary);
            cursor: pointer;
            padding: 4px;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark);
            cursor: pointer;
            padding: 0.5rem;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .user-menu {
                align-self: flex-end;
            }
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar" id="sidebar">
            <div class="nav-logo">
                <h2><i class="fas fa-store"></i> {{ config('app.name', 'Store') }}</h2>
            </div>

            <nav class="nav-menu">
                <a href="{{ url('/dashboard') }}" class="nav-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/profile') }}" class="nav-item active">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile Settings</span>
                </a>
                <a href="{{ url('/orders') }}" class="nav-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span>My Orders</span>
                </a>
                <a href="{{ url('/wishlist') }}" class="nav-item">
                    <i class="fas fa-heart"></i>
                    <span>Wishlist</span>
                </a>
                <a href="{{ url('/addresses') }}" class="nav-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Address Book</span>
                </a>
                <a href="{{ url('/payment-methods') }}" class="nav-item">
                    <i class="fas fa-credit-card"></i>
                    <span>Payment Methods</span>
                </a>
                <a href="{{ url('/notifications') }}" class="nav-item">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                </a>

                <div style="margin-top: 2rem; padding: 0 2rem;">
                    <div style="border-top: 1px solid var(--border); padding-top: 1.5rem;">
                        <a href="{{ url('/') }}" class="nav-item">
                            <i class="fas fa-store-alt"></i>
                            <span>Back to Store</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="nav-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </form>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <h1>Account Settings</h1>
                    <p>Manage your profile, security preferences, and account details</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon orders">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Active Orders</h4>
                        <p>3</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon wishlist">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Wishlist Items</h4>
                        <p>12</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon reviews">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Reviews</h4>
                        <p>8</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon member">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Member Since</h4>
                        <p>{{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Profile Information Card -->
            <div class="card animate-fade-in">
                <div class="card-header">
                    <h3><i class="fas fa-user-edit"></i> Personal Information</h3>
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Security Settings Card -->
            <div class="card animate-fade-in">
                <div class="card-header">
                    <h3><i class="fas fa-shield-alt"></i> Security Settings</h3>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Account Actions Card -->
            <div class="card animate-fade-in">
                <div class="card-header">
                    <h3><i class="fas fa-cog"></i> Account Actions</h3>
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                </div>
                <div class="card-body">
                    <div class="grid-2">
                        <div>
                            <h4 style="margin-bottom: 0.75rem; font-weight: 600;">Download Your Data</h4>
                            <p style="color: var(--secondary); margin-bottom: 1rem; font-size: 0.95rem;">
                                Request a copy of your personal data including order history and preferences.
                            </p>
                            <button class="btn btn-outline" id="exportData">
                                <i class="fas fa-download"></i> Export Data
                            </button>
                        </div>
                        <div class="danger-zone">
                            <div class="danger-header">
                                <i class="fas fa-exclamation-circle"></i>
                                <h4>Delete Account</h4>
                            </div>
                            <div class="danger-content">
                                <p>Permanently delete your account and all associated data. This action cannot be undone.</p>
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border); text-align: center; color: var(--secondary);">
                <p style="font-size: 0.875rem;">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Store') }}. All rights reserved.
                    <span style="margin: 0 1rem;">•</span>
                    <a href="#" style="color: var(--primary); text-decoration: none;">Privacy Policy</a>
                    <span style="margin: 0 1rem;">•</span>
                    <a href="#" style="color: var(--primary); text-decoration: none;">Terms of Service</a>
                </p>
            </footer>
        </main>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon success">
            <i class="fas fa-check"></i>
        </div>
        <div class="toast-content">
            <p id="toastMessage">Profile updated successfully!</p>
        </div>
        <button class="toast-close" id="toastClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <script>
        // DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                menuToggle.innerHTML = sidebar.classList.contains('active')
                    ? '<i class="fas fa-times"></i>'
                    : '<i class="fas fa-bars"></i>';
            });

            // Toast Notification
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const toastClose = document.getElementById('toastClose');

            function showToast(message, type = 'success') {
                const icon = toast.querySelector('.toast-icon i');
                const iconContainer = toast.querySelector('.toast-icon');

                // Set icon based on type
                if (type === 'success') {
                    icon.className = 'fas fa-check';
                    iconContainer.className = 'toast-icon success';
                } else if (type === 'error') {
                    icon.className = 'fas fa-exclamation';
                    iconContainer.className = 'toast-icon error';
                } else if (type === 'warning') {
                    icon.className = 'fas fa-exclamation-triangle';
                    iconContainer.className = 'toast-icon warning';
                }

                toastMessage.textContent = message;
                toast.classList.add('show');

                // Auto hide after 4 seconds
                setTimeout(() => {
                    hideToast();
                }, 4000);
            }

            function hideToast() {
                toast.classList.remove('show');
            }

            toastClose.addEventListener('click', hideToast);

            // Form Enhancements
            const styleForms = () => {
                // Style all form inputs
                document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]').forEach(input => {
                    if (!input.classList.contains('form-control')) {
                        input.classList.add('form-control');
                    }
                });

                // Style all labels
                document.querySelectorAll('label').forEach(label => {
                    if (!label.classList.contains('form-label')) {
                        label.classList.add('form-label');
                    }
                });

                // Style primary submit buttons
                document.querySelectorAll('button[type="submit"]:not(.bg-red-600)').forEach(button => {
                    button.classList.remove('bg-blue-600', 'bg-indigo-600', 'bg-primary-600');
                    button.classList.add('btn', 'btn-primary');
                });

                // Style danger buttons
                document.querySelectorAll('button.bg-red-600').forEach(button => {
                    button.classList.remove('bg-red-600');
                    button.classList.add('btn', 'btn-danger');
                });

                // Style secondary buttons
                document.querySelectorAll('button.bg-gray-100, button.bg-gray-200').forEach(button => {
                    button.classList.remove('bg-gray-100', 'bg-gray-200');
                    button.classList.add('btn', 'btn-secondary');
                });

                // Style error messages
                document.querySelectorAll('p.text-red-600').forEach(msg => {
                    msg.classList.add('form-error');
                    // Add error icon
                    if (!msg.querySelector('i')) {
                        msg.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${msg.textContent}`;
                    }
                });

                // Add form validation
                document.querySelectorAll('.form-control').forEach(input => {
                    input.addEventListener('blur', function() {
                        validateField(this);
                    });

                    input.addEventListener('input', function() {
                        this.classList.remove('is-invalid', 'is-valid');
                    });
                });
            };

            // Form Validation
            function validateField(field) {
                if (field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                    return false;
                }

                // Email validation
                if (field.type === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        field.classList.add('is-invalid');
                        field.classList.remove('is-valid');
                        return false;
                    }
                }

                // Password validation (min 8 chars)
                if (field.type === 'password' && field.value.length > 0 && field.value.length < 8) {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                    return false;
                }

                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
                return true;
            }

            // Form Submission Handling
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Don't prevent actual form submission, just add UI feedback
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                        submitBtn.disabled = true;

                        // Simulate API call delay
                        setTimeout(() => {
                            showToast('Changes saved successfully!', 'success');
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 1000);
                    }
                });
            });

            // Delete Account Confirmation
            const deleteForm = document.querySelector('form[action*="profile"] button.btn-danger');
            if (deleteForm) {
                deleteForm.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Create custom confirmation modal
                    const modal = document.createElement('div');
                    modal.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.5);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        z-index: 1000;
                    `;

                    modal.innerHTML = `
                        <div style="background: white; border-radius: var(--radius); padding: 2rem; max-width: 400px; width: 90%; box-shadow: var(--shadow-lg);">
                            <div style="text-align: center; margin-bottom: 1.5rem;">
                                <div style="width: 64px; height: 64px; background: #fee2e2; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                    <i class="fas fa-exclamation-triangle" style="color: #dc2626; font-size: 1.5rem;"></i>
                                </div>
                                <h3 style="font-weight: 600; color: #1e293b; margin-bottom: 0.5rem;">Delete Account?</h3>
                                <p style="color: #64748b; font-size: 0.95rem;">This action cannot be undone. All your data will be permanently removed.</p>
                            </div>
                            <div style="display: flex; gap: 1rem;">
                                <button id="confirmDelete" class="btn btn-danger" style="flex: 1;">Yes, Delete Account</button>
                                <button id="cancelDelete" class="btn btn-secondary" style="flex: 1;">Cancel</button>
                            </div>
                        </div>
                    `;

                    document.body.appendChild(modal);

                    document.getElementById('cancelDelete').addEventListener('click', () => {
                        document.body.removeChild(modal);
                    });

                    document.getElementById('confirmDelete').addEventListener('click', () => {
                        deleteForm.closest('form').submit();
                    });

                    // Close modal on outside click
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) {
                            document.body.removeChild(modal);
                        }
                    });
                });
            }

            // Export Data Button
            document.getElementById('exportData')?.addEventListener('click', function() {
                showToast('Data export request has been sent to your email.', 'success');
            });

            // Initialize form styling
            styleForms();

            // Add animation to cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
