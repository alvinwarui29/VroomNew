@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Agencies</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Agencies</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

                <a href="{{ route('add.agency') }}" class="btn btn-primary">Add Agency</a>


            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Agency Name </th>
                            <th>Agency Image </th>
                            <th>Agency Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agencies as $key => $item)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->name }}</td>
                            <td> <img src="{{ (!empty($item->photo)) 
							?
							 url('uploads/admin_images/'.$item->photo)
							 :
							 url('uploads/no_image.jpg') 
							}}" style="width: 70px; height:40px;"> </td>
                            <td>{{$item->phone}}</td>

                            <td>
                                <a href="{{ route('edit.agency',$item->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('delete.agency',$item->id) }}" class="btn btn-danger">Delete</a>

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Sl</th>
                            <th>Agency Name </th>
                            <th>Agency Image </th>
                            <th>Agency Contact</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>


@endsection