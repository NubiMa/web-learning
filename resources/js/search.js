document.addEventListener('DOMContentLoaded', function() {
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
    
    searchInput.addEventListener('input', performSearch);
});