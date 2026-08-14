/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
      },
      colors: {
        brand: {
          bg: '#0B0E17',        // Deep Space Dark Background
          sidebar: '#0E131F',   // Darker Sidebar
          card: '#131927',      // Precision Card Base
          border: '#1E2638',    // Subtle Border
          textMuted: '#64748B', // Muted Text
          accent: '#6B7C96',    // Steel Blue Primary Accent
          gold: '#D97706',      // Gold/Amber Warning Accent
        }
      }
    },
  },
  plugins: [],
}