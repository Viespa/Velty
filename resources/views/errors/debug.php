<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Error en Velty</title>
    <link rel="stylesheet" href="/css/debug.css">
    <style>
        :root {
            --bg-dark: #0e0e0e;
            --bg-panel: #161616;
            --bg-code: #1c1c1c;
            --border: #2a2a2a;
            --text: #e5e5e5;
            --muted: #a1a1aa;
            --accent: #4ade80;
            --highlight: #14532d;
            --highlight-text: #bbf7d0;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            padding: 2rem;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .card {
            background: var(--bg-panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .error-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .error-header .left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .error-icon {
            width: 40px;
            height: 40px;
            border-radius: 9999px;
            background: #14532d;
            color: rgb(78, 160, 89);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .error-title {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .error-detail {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .error-code {
            background: #3f3f46;
            color: #fca5a5;
            padding: 0.3rem 1rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }

        .error-msg {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
        }

        .error-meta {
            text-align: right;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        .stack-entry {
            padding: 0.75rem 1rem;
            border-left: 3px solid var(--accent);
            background-color: var(--bg-code);
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .code-preview {
            background: var(--bg-code);
            padding: 1rem;
            border-radius: 6px;
            overflow-x: auto;
            font-family: monospace;
            font-size: 0.875rem;
        }

        .highlight-line {
            background: var(--highlight);
            color: var(--highlight-text);
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid var(--border);
            padding: 0.5rem;
            text-align: left;
            font-size: 0.875rem;
        }

        th {
            background: var(--bg-code);
            color: var(--accent);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="error-header">
                <div class="left">
                    <div class="error-icon">!</div>
                    <div class="error-title"><?= $error['type'] ?? 'Exception' ?></div>
                </div>
            </div>
            <div class="error-detail">
                <div>
                    <div class="error-msg"><?= $error['message'] ?? 'Ha ocurrido un error inesperado.' ?></div>
                </div>
                <div class="error-meta">
                    <div><strong><?= $_SERVER['REQUEST_METHOD'] ?? 'GET' ?></strong>
                        <?= $_SERVER['REMOTE_ADDR'] ?? 'unknown' ?></div>
                    <div>PHP <?= phpversion() ?> — Velty v1.0.0</div>
                </div>
            </div>
        </div>

        <div class="card grid">
            <div>
                <?php foreach ($error['trace'] as $i => $trace): ?>
                    <div class="stack-entry">
                        <div><strong>#<?= $i ?></strong> <?= $trace['file'] ?? '[internal]' ?>:<?= $trace['line'] ?? '?' ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="code-preview">
                <?= $GLOBALS['codePreview'] ?? '<em style="color: var(--muted)">Sin vista previa de código</em>' ?>
            </div>
        </div>

        <div class="card">
            <h2>Request</h2>
            <p><strong><?= $_SERVER['REQUEST_METHOD'] ?? 'GET' ?></strong> <?= $_SERVER['REQUEST_URI'] ?? '/' ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Header</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (getallheaders() as $k => $v): ?>
                        <tr>
                            <td><?= htmlspecialchars($k) ?></td>
                            <td><?= htmlspecialchars($v) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3 style="margin-top: 1rem;">Body</h3>
            <div class="code-preview">
                <?= empty($_POST) ? '<em>No body data</em>' : nl2br(htmlspecialchars(print_r($_POST, true))) ?>
            </div>
        </div>
    </div>
</body>

</html>