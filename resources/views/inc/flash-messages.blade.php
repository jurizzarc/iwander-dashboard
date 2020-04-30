<div class="row">
    <div class="col-lg-12">
        @foreach(['danger', 'info', 'success', 'warning'] as $key)
            @if (Session::has($key))
                <div class="alert alert-{{ $key }} alert-dismissible fade show" role="alert">
                    {{ Session::get($key) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endforeach
    </div>
</div>

<script>
    setTimeout(function() {
        $('.alert').alert('close');
    }, 2000);
</script>
