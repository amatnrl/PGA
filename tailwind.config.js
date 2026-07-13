/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './app/Views/**/*.php',
    './resources/**/*.{js,css}',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#D60000',
          dark: '#A00000',
        },
        secondary: '#FFFFFF',
        accent: {
          gray: '#4B4B4B',
          black: '#1A1A1A',
        },
      },
      fontFamily: {
        heading: ['Sora', 'Plus Jakarta Sans', 'sans-serif'],
        body: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
      },
      maxWidth: {
        site: '1280px',
      },
    },
  },
  plugins: [],
}
