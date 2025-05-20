let selectedAmount = 0;
let selectedTipPercent = 0;
let selectedPaymentFee = 0;
 const finishButton = document.getElementById('finish');
document.addEventListener("DOMContentLoaded", () => {

    // === Popup Elements ===
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");
    const popup = document.getElementById("popup");
    const overlay = document.getElementById("overlay");
  
    // === Screens ===
    const donationForm = document.getElementById("donationForm");
    const reviewScreen = document.getElementById("reviewScreen");
    const backBtn = document.getElementById("backBtn");
    const continueBtn = document.getElementById("continueBtn");
  
    // === Add Message ===
    const addMessageLink = document.getElementById("addMessageLink");
    const addMessageContainer = document.getElementById("addMessageContainer");
  
    // === Frequency Toggle ===
    const oneTimeBtn = document.getElementById("oneTimeBtn");
    const monthlyBtn = document.getElementById("monthlyBtn");
  
    // === Amount Selection ===
    const amountButtons = document.querySelectorAll(".donation-option");
    const otherAmountInput = document.querySelector('input[placeholder="Other amount"]');
  
    // === Main Dropdown Elements ===
    const dropdownButton = document.getElementById("dropdownDelayButton");
    const dropdown = document.getElementById("dropdownDelay");
    const dropdownItems = document.querySelectorAll(".dropdown-item");
    const dropdownSelectedText = document.getElementById("dropdownSelectedText");
    const arrow = document.getElementById("dropdownArrow");
  
    let dropdownOpen = false;
  
    // === Popup Logic ===
    const closePopup = () => {
      popup?.classList.remove("show");
      popup?.classList.add("hidden");
      overlay?.classList.add("hidden");
      donationForm?.classList.remove("hidden");
      reviewScreen?.classList.add("hidden");
    };
  
    openBtn?.addEventListener("click", () => {
      popup?.classList.remove("hidden");
      popup?.classList.add("show");
      overlay?.classList.remove("hidden");
    });
  
    closeBtn?.addEventListener("click", closePopup);
    overlay?.addEventListener("click", closePopup);
  

  
    // === Add Message Input ===
    addMessageLink?.addEventListener("click", (e) => {
      e.preventDefault();
      addMessageContainer.innerHTML = `
        <input type="text" placeholder="Enter your message" class="text-box w-full px-3 py-2 border border-gray-300 rounded" />
      `;
    });
  
    // === Frequency Button Toggle ===
    const setActive = (activeBtn, inactiveBtn) => {
      activeBtn.classList.add("c-btn");
      inactiveBtn.classList.remove("c-btn");
    };
  
    oneTimeBtn?.addEventListener("click", () => setActive(oneTimeBtn, monthlyBtn));
    monthlyBtn?.addEventListener("click", () => setActive(monthlyBtn, oneTimeBtn));
  
    // === Donation Amount Selection ===
    amountButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        amountButtons.forEach((b) => b.classList.remove("active-amount"));
        btn.classList.add("active-amount");
        otherAmountInput.value = "";
      });
    });
  
    otherAmountInput?.addEventListener("input", () => {
      amountButtons.forEach((b) => b.classList.remove("active-amount"));
    });
  
    // === Main Dropdown Logic (NO data attributes)
    function openMainDropdown() {
      dropdown.classList.remove("hidden");
      dropdownButton.style.backgroundColor = "#B39350";
      dropdownButton.style.color = "#000";
      arrow.style.transform = "rotate(180deg)";
      dropdownOpen = true;
    }
  
    function closeMainDropdown() {
      dropdown.classList.add("hidden");
      dropdownButton.style.backgroundColor = "#fff";
      dropdownButton.style.color = "#000";
      arrow.style.transform = "rotate(0deg)";
      dropdownOpen = false;
    }
  
    dropdownButton?.addEventListener("click", (e) => {
      e.stopPropagation();
      dropdownOpen ? closeMainDropdown() : openMainDropdown();
    });
  
    dropdownItems.forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropdownSelectedText.textContent = item.textContent.trim();
        closeMainDropdown();
      });
    });
  
    document.addEventListener("click", (e) => {
      if (!dropdown.contains(e.target) && !dropdownButton.contains(e.target)) {
        closeMainDropdown();
      }
    });
  
    // === Tip Dropdown Logic ===
    const tipDropdownButton = document.getElementById("tipDropdownButton");
    const tipDropdownMenu = document.getElementById("tipDropdownMenu");
    const tipDropdownItems = document.querySelectorAll(".tip-dropdown-item");
    const tipDropdownSelectedText = document.getElementById("tipDropdownSelectedText");
    const tipDropdownArrow = document.getElementById("tipDropdownArrow");
  
    let tipDropdownOpen = false;
  
    function openTipDropdown() {
      tipDropdownMenu.classList.remove("hidden");
      tipDropdownArrow.style.transform = "rotate(180deg)";
      tipDropdownButton.style.backgroundColor = "#B39350";
      tipDropdownButton.style.color = "#000000";
      tipDropdownOpen = true;
    }
  
    function closeTipDropdown() {
      tipDropdownMenu.classList.add("hidden");
      tipDropdownArrow.style.transform = "rotate(0deg)";
      tipDropdownButton.style.backgroundColor = "#ffffff";
      tipDropdownButton.style.color = "#000000";
      tipDropdownOpen = false;
    }
  
    tipDropdownButton?.addEventListener("click", (e) => {
      e.stopPropagation();
      tipDropdownOpen ? closeTipDropdown() : openTipDropdown();
    });
  
    tipDropdownItems.forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();
        tipDropdownSelectedText.textContent = item.textContent.trim();
        closeTipDropdown();
      });
    });
  
    document.addEventListener("click", (e) => {
      if (!tipDropdownButton.contains(e.target) && !tipDropdownMenu.contains(e.target)) {
        closeTipDropdown();
      }
    });
  });
  document.addEventListener('DOMContentLoaded', () => {
  
  
    const donationButtons = document.querySelectorAll('.donation-option');
    const customAmountInput = document.querySelector('input[placeholder="Other amount"]');
    const addMessageLink = document.getElementById('addMessageLink');
    const dropdownItems = document.querySelectorAll('#dropdownDelay .dropdown-item');
    const tipItems = document.querySelectorAll('.tip-dropdown-item');
   
    const continueBtn = document.getElementById('continueBtn');
  
    const donationText = document.querySelector('.a-format span.font-semibold');
    const finishAmount = document.querySelector('#finish');
    const cardFeeText = document.querySelectorAll('.a-format')[1];
    const dropdownSelectedText = document.getElementById('dropdownSelectedText');
  
    // Open popup
    document.getElementById('openBtn').addEventListener('click', () => {
      document.getElementById('popup').classList.remove('hidden');
      document.getElementById('overlay').classList.remove('hidden');
    });
  
    // Close popup
    document.getElementById('closeBtn').addEventListener('click', () => {
      document.getElementById('popup').classList.add('hidden');
      document.getElementById('overlay').classList.add('hidden');
    });
  
    // Select donation amount
    donationButtons.forEach(button => {
      button.addEventListener('click', () => {
        selectedAmount = parseFloat(button.textContent.replace('$', ''));
        customAmountInput.value = '';
        updateReviewScreen();
      });
    });
  
    // Custom donation input
    customAmountInput.addEventListener('input', () => {
      selectedAmount = parseFloat(customAmountInput.value) || 0;
      updateReviewScreen();
    });
  
    // Payment method dropdown
    dropdownItems.forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        const text = item.textContent.trim();
        dropdownSelectedText.textContent = text;
  
        switch (text) {
          case 'AMEX Card':
            selectedPaymentFee = 0.95;
            break;
          case 'Visa & Others':
            selectedPaymentFee = 0.82;
            break;
          case 'US Bank Account':
            selectedPaymentFee = 0.11;
            break;
          case 'Cash App Pay':
            selectedPaymentFee = 1.11;
            break;
          default:
            selectedPaymentFee = 0;
        }
  
        updateReviewScreen();
        document.getElementById('dropdownDelay').classList.add('hidden');
      });
    });
  
    // Tip Dropdown
    tipItems.forEach(button => {
      button.addEventListener('click', () => {
        selectedTipPercent = parseFloat(button.textContent.replace('%', '')) || 0;
        document.getElementById('tipDropdownSelectedText').textContent = button.textContent;
        document.getElementById('tipDropdownMenu').classList.add('hidden');
        updateReviewScreen();
      });
    });
  
   
continueBtn.addEventListener('click', () => {
  const nameInput = document.getElementById('nameInput');
  const emailInput = document.getElementById('emailInput');
  const customAmountInput = document.getElementById('customAmountInput');

  const nameError = document.getElementById('nameError');
  const emailError = document.getElementById('emailError');
  const amountError = document.getElementById('amountError');

  const name = nameInput.value.trim();
  const email = emailInput.value.trim();

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  let isValid = true;

  // Name check
  if (name === '') {
    nameError.classList.remove('hidden');
    isValid = false;
  } else {
    nameError.classList.add('hidden');
  }

  // Email check
  if (!emailRegex.test(email)) {
    emailError.classList.remove('hidden');
    isValid = false;
  } else {
    emailError.classList.add('hidden');
  }

  // Amount check
  if (!selectedAmount || isNaN(selectedAmount) || selectedAmount <= 0) {
    amountError.classList.remove('hidden');
    isValid = false;
  } else {
    amountError.classList.add('hidden');
  }

  // ❌ Stop here if anything is invalid
  if (!isValid) {
    return;
  }

  // ✅ All valid: show next screen
  document.getElementById('donationForm').classList.add('hidden');
  document.getElementById('reviewScreen').classList.remove('hidden');
  updateReviewScreen();
});

  
    // Back button
    document.getElementById('backBtn').addEventListener('click', () => {
      document.getElementById('reviewScreen').classList.add('hidden');
      document.getElementById('donationForm').classList.remove('hidden');
    });
  
    function updateReviewScreen() {
      const tipAmount = (selectedTipPercent / 100) * selectedAmount;
      const total = (selectedAmount + selectedPaymentFee + tipAmount).toFixed(2);
  
      if (donationText) donationText.textContent = `$${selectedAmount.toFixed(2)}`;
      if (cardFeeText) cardFeeText.innerHTML = `<span>Credit card processing fees</span><span class="font-semibold">$${selectedPaymentFee.toFixed(2)}</span>`;
      if (finishButton) finishButton.textContent = `Finish • $${total}`;
    }
  });
function calculateTotalAmount() {
  const tipAmount = (selectedTipPercent / 100) * selectedAmount;
  const total = selectedAmount + selectedPaymentFee + tipAmount;
  return parseFloat(total.toFixed(2)); // Ensures clean number
}
finishButton.addEventListener('click', async () => {
  const name = document.getElementById('nameInput').value;
  const email = document.getElementById('emailInput').value;
  const amount = calculateTotalAmount();

  try {
    const res = await fetch('/create-checkout-session', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ name, email, amount })
    });

    if (!res.ok) {
      const errorText = await res.text();
      console.error('Server error:', errorText);
      return;
    }

    const data = await res.json();

    if (data.url) {
      window.location.href = data.url; // ✅ Go to Stripe Checkout
    } else {
      console.error('Stripe session not returned:', data);
    }
  } catch (error) {
    console.error('JS Fetch error:', error);
  }
});


