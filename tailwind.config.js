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
      }
    },
  },
  plugins: [],
}
