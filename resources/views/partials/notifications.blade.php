<script>
    window.addEventListener('alert', ({
        detail: {
            success
        }
    }) => {
        Toastify({
            text: success,
            close: true,
            backgroundColor: "#fdbb11",
            duration: 3000
        }).showToast();
    })
    
    @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            close: true,
            backgroundColor: "#fdbb11",
            duration: 3000
        }).showToast();
    @endif

    @if (session('error'))
        Toastify({
            text: "{{ session('error') }}",
            close: true,
            backgroundColor: "#dc3545",
            duration: 3000
        }).showToast();
    @endif

    @if (session('message'))
        Toastify({
            text: "{{ session('message') }}",
            close: true,
            backgroundColor: "#fdbb11",
            duration: 3000
        }).showToast();
    @endif

    @if (session('warning'))
        Toastify({
            text: "{{ session('warning') }}",
            close: true,
            backgroundColor: "#ffc107",
            duration: 3000
        }).showToast();
    @endif

    @if ($errors->any())
        Toastify({
            text: "{{ $errors->first() }}",
            close: true,
            backgroundColor: "#ffc107",
            duration: 3000
        }).showToast();
    @endif
</script>
