@extends('layouts.app')


    @section('title', 'Plentymarket')
    
    
    @section('content')


        <div class="bg-light mt-3">
            <h2 class="p-2 text-muted"> PM Local Storage Initialization Report</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Plentymarket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Initialization</li>
                </ol>
            </nav>

            <div class="container-md">

                <h4 class="text-warning">Local status</h4>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>


                <div class="row m-2">
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> Initialization details:</h5>
                            <ul class="list-group m-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Date:
                                    <span class="badge bg-primary rounded-pill"> {{ $data[0]->created_at}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Number of variation(s) created:
                                    <span class="badge bg-primary rounded-pill"> {{ count($data)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Execution time:
                                    <span class="badge bg-danger rounded-pill"> {{ 3 }}</span>
                                </li>
                            </ul> 
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Last update Report:</h5>
                            <ul class="list-group m-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Date
                                    <span class="badge bg-danger rounded-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Number of variation(s) affected:
                                    <span class="badge bg-danger rounded-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A third list item:
                                    <span class="badge bg-danger rounded-pill">1</span>
                                </li>
                            </ul>                         
                        </div>
                        </div>
                    </div>
                </div>



                <table class="table table-striped table-hover table-bordered border-warning">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Item ID </th>
                            <th scope="col"> Variation ID </th>
                            <th scope="col"> External ID </th>
                            <th scope="col"> Price </th>
                            <th scope="col"> Price Gross </th>
                            <th scope="col"> Stock </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{$value -> itemId }}</td>
                            <td>{{$value -> variationId }}</td>
                            <td>{{$value -> externalId }}</td>
                            <td>{{$value -> price }}</td>
                            <td>{{$value -> priceGross }}</td>
                            <td>{{$value -> stock }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
           </div>
    
  
        </div>

    @endsection
