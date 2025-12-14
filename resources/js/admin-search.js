// resources/js/admin-search.js

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // SEARCH FUNCTIONALITY FOR ADMIN TABLES
    // ============================================
    
    const adminSearchInputs = document.querySelectorAll('[data-admin-search]');
    
    adminSearchInputs.forEach(searchInput => {
        searchInput.addEventListener('input', debounce(function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            const targetTable = e.target.dataset.adminSearch;
            const rows = document.querySelectorAll(`${targetTable} tbody tr`);
            
            let visibleCount = 0;
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Show/hide no results message
            const noResults = document.getElementById('noResults');
            if (noResults) {
                noResults.style.display = visibleCount === 0 && searchTerm !== '' ? 'table-row' : 'none';
            }
        }, 300));
    });
    
    // ============================================
    // FILTER FUNCTIONALITY (e.g., User Roles)
    // ============================================
    
    const filterSelects = document.querySelectorAll('[data-filter]');
    
    filterSelects.forEach(select => {
        select.addEventListener('change', function(e) {
            const filterValue = e.target.value.toLowerCase();
            const targetTable = e.target.dataset.filter;
            const filterColumn = parseInt(e.target.dataset.filterColumn || 2); // Default to column 2
            const rows = document.querySelectorAll(`${targetTable} tbody tr`);
            
            rows.forEach(row => {
                if (filterValue === '' || filterValue === 'all') {
                    row.style.display = '';
                } else {
                    const cells = row.querySelectorAll('td');
                    const cellText = cells[filterColumn]?.textContent.toLowerCase() || '';
                    row.style.display = cellText.includes(filterValue) ? '' : 'none';
                }
            });
        });
    });
    
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
    
    // ============================================
    // STATUS TOGGLE ANIMATIONS
    // ============================================
    
    const statusButtons = document.querySelectorAll('[data-status-toggle]');
    statusButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.closest('form').submit();
            this.disabled = true;
            this.textContent = 'Processing...';
        });
    });
    
});