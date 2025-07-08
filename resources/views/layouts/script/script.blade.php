<script>
    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
        refreshTable();
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
        
        // Add some entrance animations
        const elements = document.querySelectorAll('.content-wrapper, .form-card, .table-card');
        elements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + N for new meeting
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            if (!document.getElementById('meetingForm').classList.contains('active')) {
                toggleForm();
            }
        }
        
        // Escape to close form
        if (e.key === 'Escape') {
            if (document.getElementById('meetingForm').classList.contains('active')) {
                toggleForm();
            }
        }
    });

    // Add tooltip functionality
    function addTooltips() {
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip-custom';
                tooltip.textContent = this.getAttribute('title');
                tooltip.style.cssText = `
                    position: absolute;
                    background: var(--dark-gradient);
                    color: white;
                    padding: 8px 12px;
                    border-radius: 6px;
                    font-size: 0.8rem;
                    z-index: 1000;
                    pointer-events: none;
                    box-shadow: var(--shadow-elegant);
                `;
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + 'px';
                tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
                
                this.addEventListener('mouseleave', function() {
                    if (tooltip.parentNode) {
                        tooltip.parentNode.removeChild(tooltip);
                    }
                });
            });
        });
    }

    // Initialize tooltips
    setTimeout(addTooltips, 100);
</script>