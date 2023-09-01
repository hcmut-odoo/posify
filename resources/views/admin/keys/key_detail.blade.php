@extends('layouts.admin')
@section('title', 'Tạo khóa dịch vụ')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Chi tiết khoá</h1>
                <a href="/admin/api-key" class="btn btn-success">Trở về</a>
                <a href="{{ route('admin.api.key.update.get') . '?' . http_build_query(['id' => $id]) }}" class="btn btn-warning right">
                    Cập nhật khoá
                </a>
            </header>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>Mã số khoá</dt>
                    <dd>{{ $key->id }}</dd>
                    <dt>Giá trị</dt>
                    <dd>{{ $key->value }}</dd>
                    <dt>Trạng thái</dt>
                    <dd>{{ $key->status }}</dd>
                    <dt>Mô tả</dt>
                    <dd>{{ $key->description }}</dd>
                    <dt>Tạo ngày</dt>
                    <dd>{{ $key->created_at }}</dd>
                    <dt>Cập nhật ngày</dt>
                    <dd>{{ $key->updated_at }}</dd>
                </dl>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Resource</th>
                            <th>All</th>
                            <th>Add</th>
                            <th>Modify</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resources as $resource)
                            <tr>
                                <td>{{ $resource['resource'] }}</td>
                                <td>
                                    <label>
                                        <input type="checkbox" class="row-all" data-row="{{ $loop->iteration }}" disabled >
                                    </label>
                                </td>
                                @foreach ($resource['permissions'] as $permission)
                                    <td>
                                        <label>
                                            @if (isset($permission['active']) && $permission['active'] === true)
                                                <input 
                                                    type="checkbox" 
                                                    name="{{ $resource['resource'] }}_{{ $permission['permission'] }}" 
                                                    value="{{ $permission['permission_id'] }}" 
                                                    checked
                                                    disabled
                                                >
                                            @else 
                                                <input 
                                                    type="checkbox" 
                                                    name="{{ $resource['resource'] }}_{{ $permission['permission'] }}" 
                                                    value="{{ $permission['permission_id'] }}" 
                                                    disabled
                                                >
                                            @endif
                                        </label>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <img src="{{ url('/images/logo/logo-2.png') }}" width="30px" class="rounded me-2" alt="logo-2">
        <strong class="me-auto">Buy me store</strong>
        <small class="toast-time">Just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">Key copied to clipboard</div>
</div>

@if (\Session::get('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastElement = document.getElementById('toast');
            const toast = new bootstrap.Toast(toastElement);

            const showToast = () => {
                toastElement.style.display = 'block';
                toast.show();
            };

            showToast();
            const closeButton = toastElement.querySelector('.btn-close');
            closeButton.addEventListener('click', () => {
                toast.hide();
            });
        });
    </script>
@endif
@endsection

