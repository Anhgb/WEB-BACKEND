{{-- resources/views/partials/flash-messages.blade.php --}}
{{-- Hiển thị 4 loại flash: success, error, warning, info --}}
@foreach (['success', 'error', 'warning', 'info'] as $type)
    @if (session($type))
        @php
            $bs   = $type === 'error' ? 'danger' : $type;
            $icon = match($type) {
                'success' => '✅',
                'error'   => '❌',
                'warning' => '⚠️',
                default   => 'ℹ️',
            };
        @endphp
        <div class="alert alert-{{ $bs }} alert-dismissible fade show" role="alert" id="flash-{{ $type }}">
            <strong>{{ $icon }}</strong>&nbsp; {{ session($type) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach

{{-- Auto-dismiss: flash tự ẩn sau 5 giây --}}
@if (session('success') || session('error') || session('warning') || session('info'))
@push('scripts')
<script>
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (el) {
            var alert = bootstrap.Alert.getOrCreateInstance(el);
            alert.close();
        });
    }, 5000);

    // Dismiss bằng phím Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.alert-dismissible').forEach(function (el) {
                bootstrap.Alert.getOrCreateInstance(el).close();
            });
        }
    });
</script>
@endpush
@endif
