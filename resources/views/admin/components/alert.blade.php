
{{-- Validate blank and some property  --}}
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @php
                echo '<pre>';
                    print_r($errors); die();
            @endphp
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

{{-- Incorrect Password Or Email  --}}
@if (session()->has('error'))
    <div class="alert alert-danger">
       <span>{{ session('error') }}</span>
    </div>
@endif

{{-- Login success, add and edit success --}}
@if (session()->has('success'))
    <div class="alert alert-success m-2">
        <span>{{ session('success') }}</span>
    </div>
@endif
