module.exports = {
  content: ['./source/**/*.php', './*.php', './public/ui/*.js'],
  darkMode: 'class',
  theme: { extend: { colors: { 'this-teal': '#45979d', 'this-gray': '#37474f', 'blue-gray': {50:'#eceff1'} } } },
  safelist: ['bg-this-teal', 'bg-this-gray', 'text-this-gray', 'text-this-teal'],
};
