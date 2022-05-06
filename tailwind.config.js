module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      'sans': ['Poppins', 'ui-sans-serif', 'system-ui'],
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
  content: [
    './pages/**/*.{html,js}',
    './components/**/*.{html,js}',
  ],
}