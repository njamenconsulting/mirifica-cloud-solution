<!-- resources/views/index.blade.php -->
 
@extends('layouts.app')


    @section('title', 'Home')
    
    
    @section('content')

    <div class="container col-xl-10 col-xxl-8 px-4 py-2">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Grow up our business 
                <i class="bi bi-graph-up-arrow"></i>
                </h1>
                <p class="col-lg-10 fs-4"> <em>mirifica-cloud-solution</em> app is a mirifica platform that allow to retrieve products catalog (product data) from different suppliers:

                    <ol class="list-group list-group-numbered mb-2">
                        <li class="list-group-item">Arrow</li>
                        <li class="list-group-item">Digi-Key</li>
                        <li class="list-group-item">Element14</li>
                        <li class="list-group-item">Mouser</li>
                        <li class="list-group-item">Trenz</li>
                    </ol>
                </p>
                <p class="col-lg-10 fs-4">  And update the articles on our webshop automatically.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                    <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-warning" type="submit">
                <i class="bi bi-send-fill"></i> Sign up
                </button>
                <hr class="my-4">
                <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                </form>
            </div>
        </div>
    </div>
    @endsection




