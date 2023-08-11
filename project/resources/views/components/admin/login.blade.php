@extends('main')

@section('content')
<div class="content">
    <div class="container">
    	<div class="row justify-content-center">
		    <div class="col-lg-9 mt-5">
		        <div class="pb-3">
		            <div class="section shadow bg-dark p-3">
		                <div class="card-header">
                            <h3 class="card-title text-center">Login</h3>
                        </div>
		                <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
		                    <form role="form" action="{{ route('post.login') }}" method="POST">
		                        @csrf
		                        <div class="form-group mb-2">
		                            <label class="form-label">Username</label>
		                            <div class="input-group">
		                                <span class="input-group-text">
		                                    <i class="far fa-user"></i></span>
    		                            <input type="text" name="username" class="form-control" required autocomplete="off" placeholder="Username">
		                            </div>
		                        </div>
		                        <div class="form-group mb-3">
		                            <label class="form-label">Password</label>
		                            <div class="input-group">
		                                <span class="input-group-text">
		                                    <i class="fas fa-lock"></i></span>
    		                            <input type="password" name="password" class="form-control" required placeholder="Password">
		                            </div>
		                        </div>
		                            <div class="text-end">
		                                <button type="submit" name="tombol" value="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
		                            </div>
		                            <div class="text-end">
		                                <small class="text-muted">
		                                    <i>
		                                        Belum Punya Akun?
        		                                <a href="{{ route('register') }}">Daftar disini</a>
		                                    </i>
		                                </small>
		                            </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
    </div>
</div>
@endsection