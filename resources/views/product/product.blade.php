@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

<div>
    <!-- Begin Page Content -->
 <div class="container">

    @if( session('status') )
        <div class="alert alert-danger alert-dismissible my-3">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status')  }}  
         </div>
    @endif

    <!-- DataTales Example -->
    <div class="shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            <a href="{{ route('product.create') }}" class="btn btn-md btn-dark text-uppercase p-2 mt-1"><i class="fas fa-plus"></i> Create product</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="product-table" class="table table-bordered display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>IMAGE</th>
                            <th>PRICE</th>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                <img src="/storage/{{ $product->image }}" class="img-fluid" width="320" height="300" alt="product-img">
                            </td>
                            <td>
                                ₱{{ $product->price }}
                            </td>
                            <td>
                                {{ $product->category }}
                            </td>
                            <td>
                                {{ $product->brand }}
                            </td>
                            <td>
                                {{ $product->description }}
                            </td>
                            <td>  
                                 
                                <a href="/product/{{ $product->id }}/edit" class="btn btn-sm btn-light text-uppercase p-2 mt-1"><i class="far fa-edit"></i></a>
                                
                                <form action="/product/{{ $product->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger text-uppercase p-2 mt-1" type="submit"><i class="far fa-trash-alt"></i></button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
 
@endsection
