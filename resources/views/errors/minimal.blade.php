<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }

            /* Fallback styles if Vite CSS is not available */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
                background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            @media (prefers-color-scheme: dark) {
                body {
                    background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
                }
                .error-container {
                    background: #1f2937;
                    color: #f3f4f6;
                }
                .error-title {
                    color: #f9fafb;
                }
                .error-message {
                    color: #d1d5db;
                }
                .btn {
                    background: #4f46e5;
                    color: white;
                }
                .btn:hover {
                    background: #4338ca;
                }
                .btn-secondary {
                    background: #374151;
                    color: #f9fafb;
                }
                .btn-secondary:hover {
                    background: #4b5563;
                }
            }

            .error-container {
                max-width: 28rem;
                width: 100%;
                text-align: center;
                background: white;
                padding: 2rem;
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .error-code {
                font-size: 5rem;
                font-weight: 900;
                background: linear-gradient(135deg, #ef4444, #ec4899);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
                margin-bottom: 2rem;
            }

            .error-title {
                font-size: 1.875rem;
                font-weight: 700;
                color: #111827;
                margin-bottom: 1rem;
            }

            .error-message {
                font-size: 1.125rem;
                color: #4b5563;
                margin-bottom: 2rem;
                line-height: 1.625;
            }

            .button-group {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                margin-bottom: 3rem;
            }

            @media (min-width: 640px) {
                .button-group {
                    flex-direction: row;
                    justify-content: center;
                }
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                border-radius: 0.5rem;
                text-decoration: none;
                border: none;
                cursor: pointer;
                transition: all 200ms;
                font-size: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .btn:hover {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .btn-primary {
                background: #4f46e5;
                color: white;
            }

            .btn-primary:hover {
                background: #4338ca;
            }

            .btn-secondary {
                background: #e5e7eb;
                color: #111827;
            }

            .btn-secondary:hover {
                background: #d1d5db;
            }

            .error-footer {
                margin-top: 3rem;
                font-size: 0.875rem;
                color: #6b7280;
            }

            .error-footer a {
                color: #4f46e5;
                text-decoration: none;
            }

            .error-footer a:hover {
                text-decoration: underline;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.7; }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="error-container">
            <!-- Error Code with Animation -->
            <div class="error-code">
                @yield('code')
            </div>

            <!-- Error Title -->
            <h1 class="error-title">
                @yield('title')
            </h1>

            <!-- Error Message -->
            <p class="error-message">
                @yield('message')
            </p>

            <!-- Optional Exception Info in Development -->
            @if(config('app.debug'))
                @yield('exception')
            @endif

            <!-- Action Buttons -->
            <div class="button-group">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    🏠 Go Home
                </a>
                <button onclick="history.back()" class="btn btn-secondary">
                    ← Go Back
                </button>
            </div>

            <!-- Footer Message -->
            <p class="error-footer">
                If you need help, please <a href="mailto:support@app.com">contact support</a>
            </p>
        </div>
    </body>
</html>
