
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethodSelect = document.getElementById('payment_method');
    const cashSection = document.getElementById('cash-transaction');
    const bankSection = document.getElementById('bank-transaction');
    const mobileBankingSection = document.getElementById('mobile-banking');

    function updateFormVisibility() {
        const selectedValue = paymentMethodSelect.value;
        if (selectedValue === 'cash') {
            cashSection.classList.remove('hidden');
            bankSection.classList.add('hidden');
            mobileBankingSection.classList.add('hidden');
        } else if (selectedValue === 'bank') {
            cashSection.classList.add('hidden');
            bankSection.classList.remove('hidden');
            mobileBankingSection.classList.add('hidden');
        } else if (selectedValue === 'mobile_banking') {
            cashSection.classList.add('hidden');
            bankSection.classList.add('hidden');
            mobileBankingSection.classList.remove('hidden');
        } else {
            cashSection.classList.add('hidden');
            bankSection.classList.add('hidden');
            mobileBankingSection.classList.add('hidden');
        }
    }

    paymentMethodSelect.addEventListener('change', updateFormVisibility);
    updateFormVisibility();
});

document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.getElementById('success-alert');
    const errorAlert = document.getElementById('error-alert');

    function hideAlert(alert) {
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 3000);
        }
    }

    hideAlert(successAlert);
    hideAlert(errorAlert);
});
