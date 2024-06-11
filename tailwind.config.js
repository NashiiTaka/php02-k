/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.{html,php,js,ts,jsx,tsx}',
    "node_modules/preline/dist/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('preline/plugin'),
  ],
}

