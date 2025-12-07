// Theme Switcher Alpine.js Component
document.addEventListener('alpine:init', () => {
    // Theme Switcher Component
    Alpine.data('themeSwitcher', () => ({
        theme: localStorage.getItem('theme') || 'system',
        
        init() {
            this.applyTheme();
            
            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (this.theme === 'system') {
                    this.applyTheme();
                }
            });
        },
        
        setTheme(newTheme) {
            this.theme = newTheme;
            localStorage.setItem('theme', newTheme);
            this.applyTheme();
        },
        
        applyTheme() {
            const isDark = this.theme === 'dark' || 
                          (this.theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }));
    
    // Initialize theme on page load
    Alpine.store('theme', {
        init() {
            const savedTheme = localStorage.getItem('theme') || 'system';
            const isDark = savedTheme === 'dark' || 
                          (savedTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
});

// Apply theme immediately on page load (before Alpine loads)
(function() {
    const savedTheme = localStorage.getItem('theme') || 'system';
    const isDark = savedTheme === 'dark' || 
                  (savedTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
    
    if (isDark) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
})();