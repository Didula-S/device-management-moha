<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Device Management System</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(35,35,136,1) 27%, rgba(0,212,255,1) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        /* Login Container Styles */
        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Heading Styles */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
            font-weight: bold;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        /* Label Styles */
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 1rem;
            font-weight: bold;
        }

        /* Input Styles */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Alert Styles */
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            text-align: center;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Additional Styles for Flexbox Layout */
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .flex-container .form-group {
            flex: 1;
        }

        .flex-container .form-group + .form-group {
            margin-left: 1rem;
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
                border-radius: 8px;
            }

            h1 {
                font-size: 1.8rem;
            }

            button {
                font-size: 1rem;
            }

            .flex-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .flex-container .form-group {
                margin-bottom: 1.5rem;
                width: 100%;
            }

            .flex-container .form-group + .form-group {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        @if ($errors->any())
            <div class="alert">
                <strong>Error:</strong> {{ $errors->first('email') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
