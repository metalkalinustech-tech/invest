<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Processing</title>
    <style>
      :root {
        --ink: #17243a;
        --muted: #72809a;
        --blue: #2769ff;
        --blue-dark: #1550d9;
        --card: rgba(255, 255, 255, 0.94);
      }

      * { box-sizing: border-box; }

      body {
        min-height: 100vh;
        margin: 0;
        display: grid;
        place-items: center;
        overflow: hidden;
        background: #eef4ff;
        color: var(--ink);
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      }

      .orb {
        position: fixed;
        width: 36rem;
        aspect-ratio: 1;
        border-radius: 50%;
        filter: blur(1px);
        opacity: .55;
        pointer-events: none;
        animation: drift 12s ease-in-out infinite alternate;
      }
      .orb-one { top: -18rem; left: -12rem; background: #adc8ff; }
      .orb-two { right: -15rem; bottom: -20rem; background: #b9e7f7; animation-delay: -6s; }

      .panel {
        position: relative;
        width: min(92vw, 430px);
        padding: 44px 36px 34px;
        border: 1px solid rgba(255, 255, 255, .9);
        border-radius: 28px;
        background: var(--card);
        box-shadow: 0 24px 70px rgba(45, 76, 135, .18);
        text-align: center;
        animation: enter .7s cubic-bezier(.2, .8, .2, 1) both;
      }

      .status-icon {
        position: relative;
        display: grid;
        place-items: center;
        width: 92px;
        height: 92px;
        margin: 0 auto 27px;
        border-radius: 50%;
        color: var(--blue);
        background: #edf3ff;
      }
      .status-icon::before, .status-icon::after {
        content: "";
        position: absolute;
        border: 2px solid var(--blue);
        border-radius: 50%;
        animation: pulse 2.1s ease-out infinite;
      }
      .status-icon::before { inset: -9px; opacity: .32; }
      .status-icon::after { inset: -18px; opacity: .12; animation-delay: .55s; }
      .spinner {
        width: 39px;
        height: 39px;
        border: 4px solid #c9dbff;
        border-top-color: var(--blue);
        border-radius: 50%;
        animation: spin .9s linear infinite;
      }

      h1 { margin: 0; font-size: clamp(1.6rem, 5vw, 2rem); letter-spacing: -.04em; }
      p { margin: 14px auto 0; max-width: 290px; color: var(--muted); font-size: 1rem; line-height: 1.6; }
      .detail {
        display: flex;
        justify-content: center;
        gap: 9px;
        margin: 26px 0 30px;
        color: #66758f;
        font-size: .83rem;
        font-weight: 650;
      }
      .dot {
        width: 8px;
        height: 8px;
        margin-top: 5px;
        border-radius: 50%;
        background: #26b875;
        box-shadow: 0 0 0 4px #dff7ec;
        animation: blink 1.25s ease-in-out infinite;
      }
      button {
        width: 100%;
        border: 0;
        border-radius: 13px;
        padding: 15px 20px;
        color: white;
        background: var(--blue);
        box-shadow: 0 10px 20px rgba(39, 105, 255, .25);
        font: inherit;
        font-weight: 750;
        cursor: pointer;
        transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
      }
      button:hover { background: var(--blue-dark); transform: translateY(-2px); box-shadow: 0 14px 24px rgba(39, 105, 255, .3); }
      button:active { transform: translateY(0); }
      button:focus-visible { outline: 3px solid #9bbcff; outline-offset: 3px; }

      @keyframes spin { to { transform: rotate(360deg); } }
      @keyframes pulse { 0%, 100% { transform: scale(.88); opacity: 0; } 35% { opacity: .33; } 70% { transform: scale(1.07); opacity: 0; } }
      @keyframes blink { 50% { opacity: .35; transform: scale(.8); } }
      @keyframes drift { to { transform: translate(36px, 38px) scale(1.08); } }
      @keyframes enter { from { opacity: 0; transform: translateY(22px) scale(.97); } to { opacity: 1; transform: none; } }
      @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; scroll-behavior: auto !important; } }
    </style>
  </head>
  <body>
    <input type="hidden" id="amount" value="<?php echo $_GET['amount']; ?>">
    <div class="orb orb-one"></div>
    <div class="orb orb-two"></div>
    <main class="panel" aria-live="polite">
      <div class="status-icon" aria-label="Payment processing"><div class="spinner"></div></div>
      <h1>Payment of $<span id="amountDisplay"></span> is processing</h1>
      <p>Please wait for confirmation shortly. This can take a moment.</p>
      <div class="detail"><span class="dot"></span><span>Securely verifying your payment</span></div>
      <button type="button" id="okayButton">Okay</button>
    </main>
    <script>
      const amount = document.getElementById('amount').value;
      //console.log(amount);
      const amountDisplay = document.getElementById('amountDisplay');
      amountDisplay.textContent = amount;

      const button = document.getElementById('okayButton');
      button.addEventListener('click', () => {
        button.textContent = 'We’ll notify you shortly';
        button.disabled = true;
        button.style.opacity = '.78';
        button.style.cursor = 'default';

        //redirect to dashbord
        setTimeout(()=>{
          document.location = 'dashbord_index.php';
        },2000)
      });
    </script>
  </body>
</html>
