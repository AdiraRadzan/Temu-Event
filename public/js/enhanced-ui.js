/**
 * TemuEvent - Modern UI/UX JavaScript
 * Enhanced User Experience & Interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ====== SMOOTH SCROLLING ======
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    // ====== SIDEBAR TOGGLE ======
    function initSidebarToggle() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if (!sidebar || !sidebarToggle) return;
        
        function toggleSidebar() {
            sidebar.classList.toggle('show');
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle('show');
            }
            document.body.classList.toggle('sidebar-open');
        }
        
        function closeSidebar() {
            sidebar.classList.remove('show');
            if (sidebarOverlay) {
                sidebarOverlay.classList.remove('show');
            }
            document.body.classList.remove('sidebar-open');
        }
        
        sidebarToggle.addEventListener('click', toggleSidebar);
        
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }
        
        // Close sidebar on outside click (mobile)
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    closeSidebar();
                }
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
    }
    
    // ====== LOADING ANIMATIONS ======
    function initLoadingAnimations() {
        // Fade in animation for cards
        const cards = document.querySelectorAll('.card, .stats-card, .event-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
        
        // Stagger animation for stats cards
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('fade-in-up');
        });
    }
    
    // ====== INTERACTIVE CARDS ======
    function initInteractiveCards() {
        const cards = document.querySelectorAll('.card-hover-lift, .event-card, .stats-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
                this.style.boxShadow = 'var(--shadow-xl)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'var(--shadow-sm)';
            });
        });
    }
    
    // ====== PROGRESS BAR ANIMATION ======
    function initProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBar = entry.target;
                    const width = progressBar.style.width || '0%';
                    progressBar.style.width = '0%';
                    
                    setTimeout(() => {
                        progressBar.style.transition = 'width 1s ease-out';
                        progressBar.style.width = width;
                    }, 200);
                    
                    observer.unobserve(progressBar);
                }
            });
        }, { threshold: 0.5 });
        
        progressBars.forEach(bar => observer.observe(bar));
    }
    
    // ====== FORM ENHANCEMENTS ======
    function initFormEnhancements() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                // Add floating label effect
                input.addEventListener('focus', function() {
                    this.parentNode.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentNode.classList.remove('focused');
                    }
                });
                
                // Real-time validation
                input.addEventListener('input', function() {
                    validateField(this);
                });
            });
            
            // Form submission loading state
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    submitBtn.disabled = true;
                }
            });
        });
    }
    
    // ====== TOOLTIP & POPOVER ======
    function initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                customClass: 'tooltip-modern'
            });
        });
        
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, {
                customClass: 'popover-modern'
            });
        });
    }
    
    // ====== SEARCH FUNCTIONALITY ======
    function initSearchEnhancements() {
        const searchInputs = document.querySelectorAll('input[type="search"], .search-input');
        
        searchInputs.forEach(input => {
            let searchTimeout;
            
            input.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value;
                
                if (query.length > 2) {
                    searchTimeout = setTimeout(() => {
                        performSearch(query, this);
                    }, 300);
                }
            });
        });
    }
    
    function performSearch(query, input) {
        // Add search loading indicator
        const container = input.closest('.input-group') || input.parentNode;
        const existingIndicator = container.querySelector('.search-indicator');
        
        if (existingIndicator) {
            existingIndicator.remove();
        }
        
        const indicator = document.createElement('div');
        indicator.className = 'search-indicator position-absolute end-0 top-50 translate-middle-y me-3';
        indicator.innerHTML = '<i class="fas fa-spinner fa-spin text-muted"></i>';
        container.style.position = 'relative';
        container.appendChild(indicator);
        
        // Simulate search (replace with actual search logic)
        setTimeout(() => {
            indicator.remove();
            // Add search results highlighting or dropdown here
        }, 500);
    }
    
    // ====== NOTIFICATIONS ======
    function initNotifications() {
        const notificationContainer = document.createElement('div');
        notificationContainer.id = 'notification-container';
        notificationContainer.className = 'position-fixed top-0 end-0 p-3';
        notificationContainer.style.zIndex = '9999';
        document.body.appendChild(notificationContainer);
    }
    
    function showNotification(message, type = 'info', duration = 5000) {
        const container = document.getElementById('notification-container');
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show d-flex align-items-center`;
        notification.style.marginBottom = '0.5rem';
        notification.innerHTML = `
            <i class="fas fa-${getNotificationIcon(type)} me-2"></i>
            <div>${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        container.appendChild(notification);
        
        // Auto remove after duration
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, duration);
    }
    
    function getNotificationIcon(type) {
        const icons = {
            'success': 'check-circle',
            'danger': 'exclamation-triangle',
            'warning': 'exclamation-circle',
            'info': 'info-circle'
        };
        return icons[type] || 'info-circle';
    }
    
    // ====== FIELD VALIDATION ======
    function validateField(field) {
        const value = field.value.trim();
        const type = field.type;
        let isValid = true;
        let message = '';
        
        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            message = 'Field ini wajib diisi';
        }
        
        // Email validation
        if (type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                message = 'Format email tidak valid';
            }
        }
        
        // Phone validation
        if (field.name === 'phone' && value) {
            const phoneRegex = /^[\d\s\-\+\(\)]+$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                message = 'Format nomor telepon tidak valid';
            }
        }
        
        // Update field state
        updateFieldState(field, isValid, message);
        return isValid;
    }
    
    function updateFieldState(field, isValid, message) {
        // Remove existing feedback
        const existingFeedback = field.parentNode.querySelector('.invalid-feedback, .valid-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }
        
        // Add feedback
        const feedback = document.createElement('div');
        feedback.className = isValid ? 'valid-feedback' : 'invalid-feedback';
        feedback.textContent = message || (isValid ? 'Looks good!' : 'Please provide a valid value.');
        
        // Update field classes
        field.classList.remove('is-valid', 'is-invalid');
        field.classList.add(isValid ? 'is-valid' : 'is-invalid');
        
        field.parentNode.appendChild(feedback);
    }
    
    // ====== THEME TOGGLE ======
    function initThemeToggle() {
        const themeToggle = document.getElementById('theme-toggle');
        if (!themeToggle) return;
        
        // Check for saved theme preference or default to 'light'
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
        
        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update toggle icon
            const icon = this.querySelector('i');
            icon.className = newTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
        });
    }
    
    // ====== LAZY LOADING ======
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // ====== KEYBOARD SHORTCUTS ======
    function initKeyboardShortcuts() {
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[type="search"], .search-input');
                if (searchInput) {
                    searchInput.focus();
                }
            }
            
            // Escape to close modals/sidebars
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.modal.show');
                const openSidebar = document.querySelector('.sidebar.show');
                
                if (openModal) {
                    const modal = bootstrap.Modal.getInstance(openModal);
                    if (modal) modal.hide();
                }
                
                if (openSidebar) {
                    document.getElementById('sidebar').classList.remove('show');
                    document.getElementById('sidebarOverlay').classList.remove('show');
                }
            }
        });
    }
    
    // ====== PERFORMANCE MONITORING ======
    function initPerformanceMonitoring() {
        // Monitor page load time
        window.addEventListener('load', function() {
            const loadTime = performance.now();
            console.log(`Page loaded in ${loadTime.toFixed(2)}ms`);
            
            // Track Core Web Vitals
            if ('web-vital' in window) {
                // Add web-vitals tracking here if needed
            }
        });
    }
    
    // ====== INITIALIZE ALL FEATURES ======
    initSmoothScrolling();
    initSidebarToggle();
    initLoadingAnimations();
    initInteractiveCards();
    initProgressBars();
    initFormEnhancements();
    initTooltips();
    initSearchEnhancements();
    initNotifications();
    initThemeToggle();
    initLazyLoading();
    initKeyboardShortcuts();
    initPerformanceMonitoring();
    
    // ====== GLOBAL ERROR HANDLING ======
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
        // You could send error reports to your analytics service here
    });
    
    // ====== UTILITY FUNCTIONS ======
    window.TemuEvent = {
        showNotification,
        validateField,
        performSearch,
        version: '3.0.0'
    };
});

// ====== CSS VARIABLES FOR DYNAMIC THEMING =====
function updateCSSVariables(variables) {
    const root = document.documentElement;
    Object.entries(variables).forEach(([key, value]) => {
        root.style.setProperty(`--${key}`, value);
    });
}

// Example usage:
// updateCSSVariables({
//     'primary-500': '#3b82f6',
//     'gray-100': '#f1f5f9'
// });