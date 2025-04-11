<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>404 - Página no encontrada</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root {
      --bg: #1e1e1e;
      --panel: #252526;
      --text: #d4d4d4;
      --muted: #9ca3af;
      --accent: #4ade80;
    }
    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Fira Code', monospace;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      padding: 2rem;
    }
    .card {
      background: var(--panel);
      padding: 2rem;
      border-radius: 10px;
      border: 1px solid #3c3c3c;
      text-align: center;
      max-width: 500px;
      width: 100%;
    }
    h1 {
      font-size: 3rem;
      color: var(--accent);
      margin-bottom: 0.5rem;
    }
    p {
      font-size: 1rem;
      color: var(--muted);
    }
    a.button {
      display: inline-block;
      margin-top: 1.5rem;
      padding: 0.75rem 1.5rem;
      border-radius: 6px;
      background: var(--accent);
      color: black;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.2s ease;
    }
    a.button:hover {
      background: #22c55e;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>404</h1>
    <p>La página que buscas no existe o fue movida.</p>
  </div>
</body>
</html>
