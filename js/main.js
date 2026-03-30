// main.js - Basic JS for Uni-DMS
// Add interactivity or search filter logic here

document.addEventListener('DOMContentLoaded', function() {
    // Example: Simple search filter for cards
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            document.querySelectorAll('.card').forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
});