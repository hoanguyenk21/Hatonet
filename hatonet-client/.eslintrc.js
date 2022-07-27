module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
  },
  parser: '@babel/eslint-parser',
  parserOptions: {
    parser: '@babel/eslint-parser',
    requireConfigFile: false,
    sourceType: 'module',
  },
  extends: [
    '@nuxtjs',
    'plugin:nuxt/recommended',
    'eslint:recommended',
    'prettier',
  ],
  plugins: [],
  // add your custom rules here
  rules: {
    semi: ['error', 'always'],
    camelCase: ['error', 'always'],
    indent: [2, 'tab'],
    'nuxt/no-cjs-in-config': 'off',
    'vue/html-indent': ['error', 'tab'],
    'vue/html-closing-bracket-newline': 'off',
    'no-tabs': 'off',
    'vue/multi-word-component-names': [
      'error',
      {
        ignores: ['index'],
      },
    ],
    'no-empty': 'warn',
    'no-cond-assign': ['error', 'always'],
    'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'no-await-in-loop': ['error', 'always'],
    'no-dupe-keys': ['error', 'always'],
    'no-duplicate-imports': ['error', { includeExports: true }],
    'no-irregular-whitespace': ['error', 'always'],
    'max-lines-per-function': ['error', { max: 20 }],
    'no-alert': ['error', 'always'],
    'no-unused-vars': ['error', { args: 'none' }],
    'for-direction': 'off',
  },
}
