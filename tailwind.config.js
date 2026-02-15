/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      container: {
        center: true,
        padding: '1rem',
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
          '2xl': '1280px',
        },
      },
      animation: {
        'slow-zoom': 'slow-zoom 20s linear infinite',
      },
      keyframes: {
        'slow-zoom': {
          '0%': { transform: 'scale(1.1)' },
          '100%': { transform: 'scale(1.25)' },
        }
      },
      colors: {
        'safari-orange': '#E89B3C',
        'safari-gold': '#C7A968',
        'safari-terracotta': '#D4744F',
        'safari-sunset': '#F4A261',
        'safari-sand': '#E8D5B5',
      }
    },
  },
  plugins: [],
}
