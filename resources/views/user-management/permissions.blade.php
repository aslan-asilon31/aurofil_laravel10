@extends('../layouts/backend_layout')

@section('content')
<div class="row">
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h2>Permission Management</h2>
                </div>
                <div class="pull-right">
                    {{-- @can('permission-create') --}}
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create New permission</a>
                    {{-- @endcan --}}
                </div>
            </div>
            <div class="card-body">

                
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                
                <div class="table-responsive p-0">
                    
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>1
                            <td>{{ $permission->guard_name }}</td>1
                            <td>
                                <a class="btn btn-info" href="{{ route('permissions.show',$permission->id) }}"> <i class="fa fa-eye"></i> </a>
                                {{-- @can('permission-edit') --}}
                                    <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}"><i class="fa fa-edit"></i> </a>
                                {{-- @endcan --}}
                                {{-- @can('permission-delete') --}}
                                    {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                        {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-lg', 'type' => 'submit']) }}
                                    {!! Form::close() !!}
                                {{-- @endcan --}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    
                    {!! $permissions->render() !!}
                </div>
            </div>

        </div>
@endsection