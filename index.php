<?php
require_once __DIR__ . '/inc/utils.php';
// Simple routing
$action = $_GET['action'] ?? '';
if ($action === 'log' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Expect JSON body
    $payload = json_decode(file_get_contents('php://input'), true) ?: [];
    $result = log_resolution($payload);
    header('Content-Type: application/json');
    echo json_encode(['ok' => $result]);
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>What Is My Screen Resolution</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="container">
    <h1>What Is My Screen Resolution</h1>
    <p class="lead">Detects viewport, screen size, device pixel ratio and shows example math.</p>

    <section class="card" id="results">
      <h2>Detected values</h2>
      <dl>
        <dt>Viewport (CSS pixels)</dt><dd id="viewport">—</dd>
        <dt>Screen (CSS pixels)</dt><dd id="screen">—</dd>
        <dt>Device Pixel Ratio</dt><dd id="dpr">—</dd>
        <dt>Physical pixels (approx)</dt><dd id="physical">—</dd>
      </dl>
      <p class="note">Tip: Resize your browser, then click <em>Update</em>.</p>
      <div class="controls">
        <button id="updateBtn">Update</button>
        <button id="logBtn">Send to server (log)</button>
      </div>
    </section>

    <section class="card">
      <h2>Example math</h2>
      <pre id="math">—</pre>
    </section>

    <footer>
      <small>Privacy: this demo does not collect personal data by default.</small>
    </footer>
  </main>

  <script src="assets/js/main.js"></script>
</body>
</html>