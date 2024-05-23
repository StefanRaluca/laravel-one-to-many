@extends('layouts.admin')
@section('content')
    <div class="container">
        @include('partials.error')
        @include('partials.message')

        <div class="d-flex justify-content-between align-items-center py-3">
            <h2>Types of project</h2>
            {{--   <a href="{{ route('admin.types.create') }}" class="btn btn-primary m-1">Add a new project</a> --}}
        </div>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" style="width: 20%">Name</th>
                        <th scope="col" style="width: 20%">Slug</th>
                        <th scope="col" style="width: 30%">Description</th>
                        <th scope="col" style="width: 15%">Active</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr class="">
                            <td scope="row">{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->slug }}</td>
                            <td>{{ $type->description }}</td>
                            <td>{{ $type->active }}</td>
                            {{--   <td><a href="{{ route('admin.types.show', $project) }}" class="btn btn-dark m-1"><i
                                        class="fa fa-eye" aria-hidden="true"></i></a>

                                <a href="{{ route('admin.types.edit', $project->id) }}" class="btn btn-dark  m-1"><i
                                        class="fa fa-pencil" aria-hidden="true"></i></a>


                                @include('partials.form-delete')
                            </td> --}}
                        </tr>

                    @empty

                        <tr class="">
                            <td scope="row" colspan="7">Nothing to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
