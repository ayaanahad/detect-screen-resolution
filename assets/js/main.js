// Detect and display screen/viewport info. Also math example.
function detect() {
  const viewportW = window.innerWidth;
  const viewportH = window.innerHeight;
  const screenW = screen.width; // CSS pixels
  const screenH = screen.height;
  const dpr = window.devicePixelRatio || 1;
  const physicalW = Math.round(screenW * dpr);
  const physicalH = Math.round(screenH * dpr);

  return {
    viewport: {w: viewportW, h: viewportH},
    screen: {w: screenW, h: screenH},
    dpr: dpr,
    physical: {w: physicalW, h: physicalH}
  };
}

function render(data) {
  document.getElementById('viewport').textContent = data.viewport.w + ' × ' + data.viewport.h + ' CSS px (window.innerWidth/innerHeight)';
  document.getElementById('screen').textContent = data.screen.w + ' × ' + data.screen.h + ' CSS px (screen.width/height)';
  document.getElementById('dpr').textContent = data.dpr;
  document.getElementById('physical').textContent = data.physical.w + ' × ' + data.physical.h + ' physical device pixels (approx)';

  const math = `CSS viewport: ${data.viewport.w} × ${data.viewport.h} px\n`+
               `Screen (CSS px): ${data.screen.w} × ${data.screen.h} px\n`+
               `devicePixelRatio: ${data.dpr}\n`+
               `Physical pixels approx: ${data.screen.w} × ${data.dpr} = ${data.physical.w} px (width)\n`+
               `Example — If you have an image 1200px wide at DPR=2 it will appear as 600 CSS px wide on screen (1200 / 2 = 600).\n`;
  document.getElementById('math').textContent = math;
}

function sendToServer(payload) {
  fetch('?action=log', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  }).then(r => r.json()).then(j => {
    alert(j.ok ? 'Logged successfully' : 'Logging failed');
  }).catch(e => {
    alert('Error sending to server');
  });
}

// Init
function update() {
  const data = detect();
  render(data);
  return data;
}

document.addEventListener('DOMContentLoaded', () => {
  let current = update();

  document.getElementById('updateBtn').addEventListener('click', () => {
    current = update();
  });

  document.getElementById('logBtn').addEventListener('click', () => {
    if (!confirm('Send basic device info to the server for logging?')) return;
    sendToServer(current);
  });

  // Also update on resize (debounced)
  let t;
  window.addEventListener('resize', () => {
    clearTimeout(t);
    t = setTimeout(update, 250);
  });
});
