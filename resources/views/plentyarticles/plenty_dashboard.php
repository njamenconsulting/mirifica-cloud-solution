<!-- resources/views/index.blade.php -->
 
@extends('layouts.app')


    @section('title', 'Plentymarket')
    
    
    @section('content')


        <div class="bg-light m-2 p-2">
            <h2 class="p-2 text-muted"> Plentymarket Updating Report</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Plentymarket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                </ol>
            </nav>

            <div class="container-md">

                <h4 class="text-warning">Description</h4>

                <table class="table table-striped table-hover table-bordered border-warning">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> External ID </th>
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
