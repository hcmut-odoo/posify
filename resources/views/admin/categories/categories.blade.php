@extends('layouts.admin')

@section('content')
    @push('scripts')
        <script type="text/javascript">
            document.title = 'Danh sách các mục sản phẩm';
        </script>
    @endpush

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Thể loại sản phẩm</h1>
                    <a href="/admin/products/create" class="btn btn-success">Thêm</a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a class="fa fa-eye btn btn-info btn-sm" href="/admin/categories/details?id={{ $item->id }}"></a>
                                        <a class="fa fa-pencil btn btn-warning btn-sm" href="/admin/categories/edit?id={{ $item->id }}"></a>
                                        <a class="fa fa-trash btn btn-danger btn-sm" href="/admin/categories/delete?id={{ $item->id }}"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
