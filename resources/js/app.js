import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-reveal');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Initial check for elements
    document.querySelectorAll('.scroll-reveal').forEach(el => {
        observer.observe(el);
    });
});

// Handle Livewire navigation
document.addEventListener('livewire:navigated', () => {
    document.querySelectorAll('.scroll-reveal').forEach(el => {
        el.classList.remove('animate-reveal');
        // Initial observer might need re-attaching or just a slight delay
        setTimeout(() => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-reveal');
                    }
                });
            });
            observer.observe(el);
        }, 100);
    });
});
