@if (session('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@endif

@if (session('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
@endif
@if (count($errors) > 0)
    <div class = "alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif