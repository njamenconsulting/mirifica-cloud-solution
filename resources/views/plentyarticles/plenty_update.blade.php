@extends('layouts.app')


    @section('title', 'Plenty')
    
    
    @section('content')


        <div class="bg-light mt-3">
            <h2 class="p-2 text-muted"> Plenty Local Storage Update Report</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Plenty</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
                </ol>
            </nav>

            <div class="container-md">

                <h4 class="text-warning">Update status</h4>

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p> Plenty local storage has been successfully updated. You can see detail of execution below:</p>
                        <li class="list-group-item">Number of product(s) updated : {{ count($variations) }} </li>
                        <hr>
                    <em class="text-danger">Now you must updating PM system</em>
                </div>

                <table class="table table-striped table-hover table-bordered border-warning">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Extenrnal ID </th>
                            <th scope="col"> Stock </th>
                            <th scope="col"> Price </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($variations as $variation)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{$variation -> productId }}</td>
                            <td>{{$variation -> stock }}</td>
                            <td>{{$variation -> price }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
           </div>
  
        </div>

    @endsection
