@extends('layout.auth')

@section('main')
<body>
    <div class="container">
        <div class="wrapper">
            <form class="auth-container" method="POST" action="{{ route('register') }}">
				{{ csrf_field() }}

                <div class="page-title">
                    <h2>SIGN UP</h2>
                </div>

                <div class="form-container">
                    <input type="text" name="username" placeholder="username" required>
                </div>

                <div class="form-container">
                    <input type="password" name="password" placeholder="password" required>
                </div>

                <div class="form-container">
                    <input type="password" name="password_confirmation" placeholder="confirm password" required>
                </div>

                <button class="button-submit" type="submit">Signup</button>

                <span class="redirect">
                    Already have an account? <a href="/login">Login here</a>
                </span>
            </form>
        </div>
    </div>
</body>
@endsection