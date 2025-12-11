// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

// Smooth scrolling for navigation links
document.querySelectorAll('a.nav-link').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        if (this.getAttribute('href').startsWith('#')) {
            e.preventDefault()
            const targetId = this.getAttribute('href')
            const targetElement = document.querySelector(targetId)
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                })
            }
        }
    })
})

// Form validation
// Reservation form
const reservationForm = document.getElementById('reservationForm')
if (reservationForm) {
    reservationForm.addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        this.classList.add('was-validated')
    })
}

// Contact form
const contactForm = document.getElementById('contactForm')
if (contactForm) {
    contactForm.addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        this.classList.add('was-validated')
    })
}

// Login form
const loginForm = document.getElementById('loginForm')
if (loginForm) {
    loginForm.addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        this.classList.add('was-validated')
    })
}

// Register form
const registerForm = document.getElementById('registerForm')
if (registerForm) {
    registerForm.addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        this.classList.add('was-validated')
    })
}

// Initialize image gallery if exists
if (document.querySelector('.gallery-img')) {
    document.querySelectorAll('.gallery-img').forEach(img => {
        img.addEventListener('click', function() {
            const src = this.getAttribute('src')
            document.getElementById('galleryModalImg').setAttribute('src', src)
            const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'))
            galleryModal.show()
        })
    })
}