<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Login</h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('loginMatch') }}" method="POST">
                            @csrf 

                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="useremail" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="userpassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="userpassword" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <a href="/" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>

                    {{-- Error Handling Section --}}
                    @if ($errors->any())
                        <div class="card-footer bg-light">
                            <div class="alert alert-danger mb-0">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>