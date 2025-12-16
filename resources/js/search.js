// resources/js/search.js (FIXED & ENHANCED)

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 Search module loaded');
    
    // ============================================
    // MODULE SEARCH (Dashboard & Progress)
    // ============================================
    const searchInput = document.getElementById('moduleSearch');
    
    if (searchInput) {
        console.log('✅ Module search input found');
        
        searchInput.addEventListener('input', debounce(function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            console.log('Searching for:', searchTerm);
            
            const moduleCards = document.querySelectorAll('[data-module-card]');
            let visibleCount = 0;
            
            moduleCards.forEach(card => {
                const title = (card.dataset.moduleTitle || '').toLowerCase();
                const description = (card.dataset.moduleDescription || '').toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            console.log(`Found ${visibleCount} modules`);
            
            // Show/hide no results message
            const noResults = document.getElementById('noSearchResults');
            if (noResults) {
                noResults.style.display = visibleCount === 0 && searchTerm !== '' ? 'block' : 'none';
            }
        }, 300));
    }
    
    // ============================================
    // TOP BAR SEARCH (Header)
    // ============================================
    const headerSearches = document.querySelectorAll('input[placeholder="Cari kursus..."]');
    
    headerSearches.forEach(headerSearch => {
        if (headerSearch && headerSearch.id !== 'moduleSearch') {
            console.log('✅ Header search found');
            
            headerSearch.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const term = e.target.value.trim();
                    if (term.length >= 2) {
                        window.location.href = `/user/modules?search=${encodeURIComponent(term)}`;
                    }
                }
            });
        }
    });
    
    // ============================================
    // HANDLE URL SEARCH PARAM (Modules Page)
    // ============================================
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    
    if (searchParam && searchInput) {
        searchInput.value = searchParam;
        searchInput.dispatchEvent(new Event('input'));
    }
    
    // ============================================
    // DEBOUNCE FUNCTION
    // ============================================
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
});