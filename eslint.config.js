import js from '@eslint/js';
import tseslint from 'typescript-eslint';
import reactPlugin from 'eslint-plugin-react';
import reactHooks from 'eslint-plugin-react-hooks';
import importPlugin from 'eslint-plugin-import';
import prettierPlugin from 'eslint-plugin-prettier';
import globals from 'globals';

export default [
    {
        ignores: [
            'node_modules',
            'vendor',
            'storage',
            'bootstrap',
            'public',
            'database',
            'routes',
            'app',
        ],
    },
    {
        files: ['resources/**/*.{js,jsx,ts,tsx}'],

        languageOptions: {
            ecmaVersion: 'latest',
            sourceType: 'module',
            parser: tseslint.parser,
            parserOptions: { ecmaFeatures: { jsx: true } },
            globals: {
                ...globals.browser,
                ...globals.node,
                ...globals.es2021,
            },
        },

        plugins: {
            '@typescript-eslint': tseslint.plugin,
            react: reactPlugin,
            'react-hooks': reactHooks,
            import: importPlugin,
            prettier: prettierPlugin,
        },

        rules: {
            ...js.configs.recommended.rules,
            ...tseslint.configs.recommended.rules,
            ...reactPlugin.configs.recommended.rules,
            ...reactHooks.configs.recommended.rules,
            ...importPlugin.configs.recommended.rules,
            ...prettierPlugin.configs.recommended.rules,

            'prettier/prettier': ['error', { printWidth: 180, tabWidth: 4 }],
            'react/react-in-jsx-scope': 'off',
        },

        settings: {
            react: { version: 'detect' },
        },
    },
];
