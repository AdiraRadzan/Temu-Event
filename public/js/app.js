/**
 * TemuEvent JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Initialize date pickers
    const dateInputs = document.querySelectorAll('input[type="datetime-local"]');
    dateInputs.forEach(function(input) {
        // Set minimum date to today for if (! date inputs
       input.hasAttribute('readonly')) {
            const today = new Date().toISOString().slice(0, 16);
            input.setAttribute('min', today);
        }
    });

    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Event registration button
    const registerButtons = document.querySelectorAll('.event-register-btn');
    registerButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            const buttonText = this.innerHTML;
            
            // Disable button and show loading
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
            
            // Make AJAX request to register for event
            fetch('/events/' + eventId + '/register', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showAlert('success', data.message);
                    
                    // Update button
                    this.innerHTML = '<i class="bi bi-check-circle me-1"></i>Registered';
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                } else {
                    // Show error message
                    showAlert('danger', data.message);
                    
                    // Restore button
                    this.disabled = false;
                    this.innerHTML = buttonText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'An error occurred. Please try again.');
                
                // Restore button
                this.disabled = false;
                this.innerHTML = buttonText;
            });
        });
    });

    // Event favorite button
    const favoriteButtons = document.querySelectorAll('.event-favorite-btn');
    favoriteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            const buttonText = this.innerHTML;
            
            // Disable button and show loading
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
            
            // Make AJAX request to toggle favorite
            fetch('/events/' + eventId + '/favorite', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showAlert('success', data.message);
                    
                    // Update button appearance
                    if (data.action === 'added') {
                        this.innerHTML = '<i class="bi bi-heart-fill me-1"></i>Remove from Favorites';
                        this.classList.remove('btn-outline-danger');
                        this.classList.add('btn-danger');
                    } else {
                        this.innerHTML = '<i class="bi bi-heart me-1"></i>Add to Favorites';
                        this.classList.remove('btn-danger');
                        this.classList.add('btn-outline-danger');
                    }
                } else {
                    // Show error message
                    showAlert('danger', data.message);
                    
                    // Restore button
                    this.disabled = false;
                    this.innerHTML = buttonText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'An error occurred. Please try again.');
                
                // Restore button
                this.disabled = false;
                this.innerHTML = buttonText;
            });
        });
    });

    // Password visibility toggle
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });

    // Rating stars
    const ratingInputs = document.querySelectorAll('.rating-input');
    ratingInputs.forEach(function(ratingInput) {
        const ratingValue = parseInt(ratingInput.value);
        const stars = ratingInput.parentElement.querySelectorAll('.star');
        
        // Set initial state
        updateStars(stars, ratingValue);
        
        // Add event listeners to stars
        stars.forEach(function(star, index) {
            star.addEventListener('click', function() {
                ratingInput.value = index + 1;
                updateStars(stars, index + 1);
            });
            
            star.addEventListener('mouseenter', function() {
                updateStars(stars, index + 1);
            });
        });
        
        ratingInput.parentElement.addEventListener('mouseleave', function() {
            updateStars(stars, ratingValue);
        });
    });
});

// Helper function to update star display
function updateStars(stars, rating) {
    stars.forEach(function(star, index) {
        if (index < rating) {
            star.classList.remove('bi-star');
            star.classList.add('bi-star-fill');
        } else {
            star.classList.remove('bi-star-fill');
            star.classList.add('bi-star');
        }
    });
}

// Helper function to show alert messages
function showAlert(type, message) {
    const alertContainer = document.getElementById('alert-container');
    
    if (!alertContainer) {
        // Create alert container if it doesn't exist
        const container = document.createElement('div');
        container.id = 'alert-container';
        container.className = 'container mt-3';
        document.body.appendChild(container);
    }
    
    const alertElement = document.createElement('div');
    alertElement.className = `alert alert-${type} alert-dismissible fade show`;
    alertElement.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.getElementById('alert-container').appendChild(alertElement);
    
    // Auto-hide after 5 seconds
    setTimeout(function() {
        const bsAlert = new bootstrap.Alert(alertElement);
        bsAlert.close();
    }, 5000);
}