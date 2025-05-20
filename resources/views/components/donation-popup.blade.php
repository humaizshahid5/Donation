<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Left-Aligned Donation Modal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f4f2;
      font-family: 'Segoe UI', sans-serif;
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.0); /* transparent backdrop */
      z-index: 1000;
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .modal-wrapper {
      width: 500px;
      background: white;
      height: 100%;
      box-shadow: 5px 0 10px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
      border-radius: 0 15px 15px 0;
      position: relative;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .modal-header h4 {
      font-size: 16px;
      letter-spacing: 2px;
      color: #b59863;
      font-weight: 600;
      margin-bottom: 0;
    }

    .modal-header .close-btn {
      font-size: 24px;
      color: #b59863;
      cursor: pointer;
    }

    .donation-box {
      background: white;
      border-radius: 10px;
      border: 1px solid #eee;
      padding: 20px 20px 0;
    }

    .donation-box h5 {
      font-weight: bold;
    }

    .tabs {
      display: flex;
      border: 1px solid #b59763;
      border-radius: 6px;
      overflow: hidden;
      margin: 20px 0 15px;
    }

    .tab {
      flex: 1;
      padding: 10px;
      text-align: center;
      cursor: pointer;
      background: white;
      color: #b59763;
      font-weight: 600;
      border: none;
    }

    .tab.active {
      background-color: #b59763;
      color: white;
    }

    .form-control,
    .form-select {
      border-radius: 6px;
      border: 1px solid #b59763;
    }

    .amount-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      margin: 20px 0;
    }

    .amount-btn {
      border: 1px solid #b59763;
      border-radius: 6px;
      padding: 10px 0;
      text-align: center;
      color: #b59763;
      font-weight: 500;
      cursor: pointer;
    }

    .amount-btn.active {
      background-color: #b59763;
      color: white;
    }

    .message-link {
      color: #b59763;
      font-weight: 500;
      font-size: 14px;
      margin-bottom: 20px;
      display: inline-block;
    }

    .bottom-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 15px;
      margin-top: 10px;
      border-top: 1px solid #dee2e6;
    }

    .form-check-label {
      color: #1d3557;
      font-weight: 500;
    }

    .continue-btn {
      background-color: #b59763;
      color: white;
      border-radius: 6px;
      padding: 10px 25px;
      font-weight: bold;
      border: none;
    }

    .other-input {
      padding: 6px 10px;
    }
  </style>
</head>
<body>

<!-- Trigger Button -->
<div class="text-center mt-5">
  <button class="btn btn-lg btn-warning text-white" onclick="document.getElementById('donationPopup').style.display='flex'">
    Donate →
  </button>
</div>

<!-- Modal Overlay -->
<div id="donationPopup" class="modal-overlay" style="display: none;">
  <div class="modal-wrapper">
    <div class="modal-header">
      <h4>DONATE</h4>
      <span class="close-btn" onclick="document.getElementById('donationPopup').style.display='none'">×</span>
    </div>

    <div class="donation-box">
      <h5 class="mb-3">Missionary Donation</h5>

      <!-- Tabs -->
      <div class="tabs">
        <button class="tab active" onclick="switchTab(this)">One-Time</button>
        <button class="tab" onclick="switchTab(this)">Monthly</button>
      </div>

      <!-- Donor Info -->
      <div class="row mb-3">
        <div class="col">
          <input type="text" class="form-control" placeholder="Donor's Name">
        </div>
        <div class="col">
          <input type="email" class="form-control" placeholder="Donor's Email">
        </div>
      </div>

      <!-- Dropdown -->
      <select class="form-select mb-3">
        <option selected>Night Bright</option>
      </select>

      <!-- Amount Buttons -->
      <div class="amount-grid">
        <div class="amount-btn">10$</div>
        <div class="amount-btn active">25$</div>
        <div class="amount-btn">50$</div>
        <div class="amount-btn">100$</div>
        <div class="amount-btn">250$</div>
        <div class="amount-btn">500$</div>
        <div class="amount-btn">1000$</div>
        <input type="text" class="form-control other-input" placeholder="Other">
      </div>

      <!-- Message Link -->
      <a href="#" class="message-link">+ Add a message</a>

      <!-- Footer Row -->
      <div class="bottom-row">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="stayAnonymous">
          <label class="form-check-label" for="stayAnonymous">Stay Anonymous</label>
        </div>
        <button class="continue-btn">Continue</button>
      </div>
    </div>
  </div>
</div>

<script>
  function switchTab(tab) {
    document.querySelectorAll('.tab').forEach(btn => btn.classList.remove('active'));
    tab.classList.add('active');
  }

  document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });
</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe("{{ config('services.stripe.key') }}");

function pay(amount, connectedAccountId) {
    fetch('/stripe/intent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ amount, account_id: connectedAccountId })
    })
    .then(res => res.json())
    .then(data => {
        stripe.confirmCardPayment(data.clientSecret, {
            payment_method: {
                card: cardElement, // use Stripe Elements here
                billing_details: { name: 'Donor Name' }
            }
        }).then(result => {
            if (result.error) {
                alert(result.error.message);
            } else {
                alert('Donation successful!');
            }
        });
    });
}
</script>


</body>
</html>
