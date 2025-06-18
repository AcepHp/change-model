<div id="loading-overlay" style="display: none;">
    <div class="loading-content">
        <div class="loader"></div>
        <div class="loading-text">Loading...</div>
    </div>
</div>

<style>
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.85);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.3s ease;
    }

    #loading-overlay.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .loading-content {
        text-align: center;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #0d6efd;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    .loading-text {
        font-size: 16px;
        color: #333;
        font-weight: 500;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>


<script>
    // Show loading overlay
    function showLoading() {
        const overlay = document.getElementById('loading-overlay');
        overlay.style.display = 'flex';
        setTimeout(() => overlay.classList.remove('hidden'), 10);
    }
    
    // Hide loading overlay
    function hideLoading() {
        const overlay = document.getElementById('loading-overlay');
        overlay.classList.add('hidden');
        setTimeout(() => overlay.style.display = 'none', 300);
    }
    
    // Show loading for any click that leads to an action
    document.addEventListener('DOMContentLoaded', function() {
        // For forms
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Only show if not already showing
                if (document.getElementById('loading-overlay').style.display === 'none') {
                    showLoading();
                }
            });
        });
        
        // For links that navigate away
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                // Only show for links that actually navigate somewhere
                if (link.href && !link.classList.contains('no-loading') && 
                    !link.getAttribute('href').startsWith('#')) {
                    showLoading();
                }
            });
        });
        
        // For buttons that trigger actions
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Don't show for buttons that are inside forms (form submit will handle it)
                if (!button.closest('form') && 
                    !button.classList.contains('no-loading')) {
                    showLoading();
                }
            });
        });
    });
    
    // Hide loading when page finishes loading (in case it was left showing)
    window.addEventListener('load', hideLoading);
    
    // Optional: Hide loading when AJAX requests complete
    // You would need to call hideLoading() in your AJAX complete callbacks
</script>