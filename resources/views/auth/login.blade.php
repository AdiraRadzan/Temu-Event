<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url={{ route('welcome') }}">
    <script>
        window.location.href = "{{ route('welcome') }}";
        setTimeout(function() {
            if (typeof bootstrap !== 'undefined') {
                var modal = new bootstrap.Modal(document.getElementById('authModal'));
                modal.show();
            }
        }, 500);
    </script>
</head>
<body>
    <p>Redirecting to login...</p>
</body>
</html>
