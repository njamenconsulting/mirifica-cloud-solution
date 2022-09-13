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
                <p>These are the articles that have been updated; </p>

                <table class="table table-striped table-hover table-bordered border-warning">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Item ID </th>
                            <th scope="col"> Variation ID </th>
                            <th scope="col"> Extenrnal ID </th>
                            <th scope="col"> Stock </th>
                            <th scope="col"> Price </th>
                            <th scope="col"> Price Gross </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($variations as $variation)
                        <tr>
                            <th scope="row">{{ $loop->index }}</th>
                            <td>{{$variation['itemId']}}</td>
                            <td>{{$variation['variationId']}}</td>
                            <td>{{$variation['externalId']}}</td>
                            <td>{{$variation['stock']}}</td>
                            <td>{{$variation['price']}}</td>
                            <td>{{$variation['priceGross']}}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
           </div>
    
  
        </div>

    @endsection
