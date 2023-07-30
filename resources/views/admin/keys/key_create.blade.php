@extends('layouts.admin')
@section('title', 'Tạo khóa dịch vụ')
@section('content')
@php
    $controllers = [
        [
            'controller' => 'User',
            'actions' => ['View', 'Edit', 'Delete'],
        ],
        [
            'controller' => 'Product',
            'actions' => ['View', 'Create', 'Edit', 'Delete'],
        ],
        [
            'controller' => 'Order',
            'actions' => ['View', 'Create', 'Edit', 'Delete'],
        ],
    ];
@endphp
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Thêm khóa dịch vụ web</h1>
            </header>
            <form action="{{ route('admin.api.key.create') }}" method="POST" style="display: inline;">
                @csrf
                <div class="panel-body">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="api-key">API Key:</label>
                            <input type="text" id="api-key" class="form-control" name="api_key">
                        </div>
                        <button type="button" class="btn btn-success" id="copy-api-key" style="display:none">Copy</button>
                        <button type="button" class="btn btn-primary" id="generate-api-key">Generate</button>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description:</label>
                        <textarea id="description" class="form-control" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="toggle-api-key">Status:</label>
                        <label class="switch">
                            <input type="checkbox" id="toggle-api-key" name="toggle_api_key">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Controller</th>
                                <th>All</th>
                                <th>View</th>
                                <th>Modify</th>
                                <th>Add</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($controllers as $controller)
                                <tr>
                                    <td>{{ $controller['controller'] }}</td>
                                    <td>
                                        <label>
                                            <input type="checkbox" class="row-all" data-row="{{ $loop->iteration }}">
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="{{ $controller['controller'] }}_view_permission">
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="{{ $controller['controller'] }}_update_permission">
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="{{ $controller['controller'] }}_create_permission">
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="{{ $controller['controller'] }}_delete_permission">
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary right-button">Tạo key</button>
            </form>
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
<script>
    // Check box permission
    var allCheckboxes = document.getElementsByClassName('row-all');
    Array.from(allCheckboxes).forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var rowNumber = this.getAttribute('data-row');
            var checkboxesInRow = document.querySelectorAll('tr:nth-child(' + rowNumber + ') input[type="checkbox"]');

            // Set all checkboxes in the row to the same
            // checked state as the "All" checkbox
            var isChecked = this.checked;
            checkboxesInRow.forEach(function (rowCheckbox) {
                if (rowCheckbox !== checkbox) {
                    rowCheckbox.checked = isChecked;
                }
            });
        });
    });

    // Generate api key
    document.getElementById('generate-api-key').addEventListener('click', generateApiKey);

    function generateRandomKey(length) {
      var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var result = '';
      var charactersLength = characters.length;
      for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      return result;
    }

    function generateApiKey() {
        var apiKeyField = document.getElementById('api-key');
        var apiKey = generateRandomKey(32);
        apiKeyField.value = apiKey;

        // Un hide the copy button
        var copyButton = document.getElementById('copy-api-key');
        copyButton.style.display = 'inline-block';
        copyButton.addEventListener('click', function () {
            apiKeyField.select();
            document.execCommand('copy');

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
            document.body.appendChild(copyMessage);
            setTimeout(function () {
                document.body.removeChild(copyMessage);
            }, 2000);
        });

        // Append the copy button to the input group
        apiKeyField.parentNode.appendChild(copyButton);
    }
</script>
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

