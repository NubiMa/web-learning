// resources/js/search.js

document.addEventListener('DOMContentLoaded', function() {
    // Module Search (Dashboard & Progress)
    const searchInput = document.getElementById('moduleSearch');
    
    if (!searchInput) return;
    
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Search function
    const performSearch = debounce(function(e) {
        const searchTerm = e.target.value.toLowerCase().trim();
        const moduleCards = document.querySelectorAll('[data-module-card]');
        
        let visibleCount = 0;
        
        moduleCards.forEach(card => {
            const title = card.dataset.moduleTitle.toLowerCase();
            const description = card.dataset.moduleDescription.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show no results message
        const noResults = document.getElementById('noSearchResults');
        if (noResults) {
            noResults.style.display = visibleCount === 0 && searchTerm !== '' ? 'block' : 'none';
        }
    }, 300);
    
    // Top bar search (in header)
    const headerSearch = document.querySelector('input[placeholder="Cari kursus..."]');
    if (headerSearch && !headerSearch.id) {
        headerSearch.addEventListener('input', debounce(function(e) {
            const term = e.target.value.toLowerCase().trim();
            if (term.length >= 2) {
                // Redirect to modules page with search query
                window.location.href = `/user/modules?search=${encodeURIComponent(term)}`;
            }
        }, 500));
    }
});