@if(session('success')) {{-- Session без доллара --}}
<div class="alert alert-success">
    {{session('success') }}
</div>
@endif

@if(session('error')) {{-- Session без доллара --}}
<div class="alert alert-danger">
    {{session('error') }}
</div>
@endif
