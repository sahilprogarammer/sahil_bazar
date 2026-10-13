<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Nonveg Bazar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f7f2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #172018;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1150px;
            padding: 25px;
        }

        .login-box {
            min-height: 650px;
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 25px 70px rgba(23, 32, 24, 0.12);
        }

        /* LEFT */

        .login-brand {
            background: linear-gradient(145deg, #123d24, #0a6b3b);
            padding: 55px;
            color: #fff;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #f59e0b;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 800;
        }

        .brand-content {
            max-width: 420px;
        }

        .brand-content h1 {
            font-size: 42px;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .brand-content p {
            color: rgba(255,255,255,.75);
            font-size: 15px;
            line-height: 1.8;
        }

        .brand-footer {
            font-size: 13px;
            color: rgba(255,255,255,.6);
        }

        /* RIGHT */

        .login-form-area {
            padding: 70px 65px;
            display: flex;
            align-items: center;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        .login-form h2 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .login-form .subtitle {
            color: #7b847d;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .input {
            width: 100%;
            height: 54px;

            border: 1px solid #e1e6e1;
            border-radius: 13px;

            padding: 0 16px;
            font-size: 14px;

            outline: none;
            transition: .2s;
        }

        .input:focus {
            border-color: #0a6b3b;
            box-shadow: 0 0 0 4px rgba(10,107,59,.08);
        }

        .password-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .forgot {
            color: #0a6b3b;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        .login-btn {
            width: 100%;
            height: 55px;

            border: none;
            border-radius: 13px;

            background: #0a6b3b;
            color: white;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;
            transition: .2s;
        }

        .login-btn:hover {
            background: #08562f;
            transform: translateY(-1px);
        }

        .security {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #8b938d;
        }

        @media(max-width: 800px) {

            .login-box {
                grid-template-columns: 1fr;
            }

            .login-brand {
                display: none;
            }

            .login-form-area {
                padding: 50px 30px;
            }

        }

    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-box">

            <div class="login-brand">

                <div class="brand-logo">

                    <div class="logo-icon">
                        🥩
                    </div>

                    <div class="brand-name">
                        Nonveg Bazar
                    </div>

                </div>

                <div class="brand-content">

                    <h1>
                        Manage your
                        marketplace
                        effortlessly.
                    </h1>

                    <p>
                        Manage products, orders, customers,
                        delivery and everything related to
                        your Nonveg Bazar marketplace from
                        one powerful dashboard.
                    </p>

                </div>

                <div class="brand-footer">
                    © {{ date('Y') }} Nonveg Bazar. Admin Panel.
                </div>

            </div>


            <div class="login-form-area">

                <form class="login-form" action="{{ url('admin/login-submit') }}" method="post">
                    @csrf
                    <h2>
                        Welcome back 👋
                    </h2>

                    <p class="subtitle">
                        Sign in to access your admin dashboard.
                    </p>


                    <div class="form-group">

                        <label>
                            Email Address
                        </label>

                        <input
                            type="email"
                            class="input"
                            name="email"
                            placeholder="admin@nonvegbazar.com"
                        >

                    </div>


                    <div class="form-group">

                        <div class="password-row">

                            <label>
                                Password
                            </label>

                            <a href="#" class="forgot">
                                Forgot password?
                            </a>

                        </div>

                        <input
                            type="password"
                            class="input"
                            name="password"
                            placeholder="Enter your password"
                        >

                    </div>


                    <button type="submit" class="login-btn">
                        Sign In to Dashboard
                    </button>


                    <div class="security">
                        🔒 Secure admin access
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>