@extends('layouts.app')


    @section('title', 'Plenty')
    
    
    @section('content')


        <div class="bg-light mt-3">
            <h2 class="p-2 text-muted"> Plenty Local Storage Initialization Report</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Plenty</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Initialization</li>
                </ol>
            </nav>

            <div class="container-md">

                <h4 class="text-warning">Creation details</h4>

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p> Plenty local storage has been successfully created. You can see detail of execution below:</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Number of product(s) created : {{ $data}} </li>
                        <li class="list-group-item">Execution time: {{ $time}} s</li>
                        <li class="list-group-item">Amount memory consumption: {{ $memory}} Mo</li>
                    </ul>
                    <hr>
                    <p class="mb-0">Now you must continue with initialization step</p>
                </div>

           </div>
  
        </div>

    @endsection
