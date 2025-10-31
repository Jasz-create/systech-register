<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'SYSTECH' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,Arial,sans-serif;background:#f5f7fb;margin:0}
    .container{max-width:960px;margin:40px auto;padding:20px;background:#fff;border-radius:12px;box-shadow:0 10px 24px rgba(0,0,0,.06)}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    label{font-weight:600;margin-bottom:6px;display:block}
    input,select{width:100%;padding:10px;border:1px solid #dbe0ea;border-radius:8px}
    .btn{background:#204ae6;color:#fff;border:none;padding:12px 18px;border-radius:10px;cursor:pointer}
    .alert{padding:12px;border-radius:8px;margin:12px 0}
    .ok{background:#e8f7ef;color:#136a3a;border:1px solid #bce7cb}
    .err{background:#fdecec;color:#9d1b1b;border:1px solid #f5b5b5}
  </style>
</head>
<body><div class="container">{{ $slot }}</div></body>
</html>
