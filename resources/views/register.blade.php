<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Register</h3>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('registerSave') }}" method="POST">
                        @csrf 

                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="username" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="useremail" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="userpassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="userpassword" required>
                        </div>

                        <div class="mb-3">
                            <label for="userpassword-confirm" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="userpassword-confirm" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Register</button>
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