@extends('dashboard.layouts.main')
@section('container')
<!-- Page Heading -->
<div class="row justify-content-center">
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @elseif(session()->has('LoginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('LoginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="col-md-6 col-lg-5">
    <main class="form-signin my-4">
        <h1 class="h3 mb-3 fw-normal text-center">{{ $title }}</h1> 
        <form action="/login" method="post">
          @csrf
          <div class="form-floating my-2">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" autofocus required>
            <label for="email">Email address</label>
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating my-2">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
    </main>
  </div>
</div>
@endsection