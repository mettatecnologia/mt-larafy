module.exports = {
    "env": {
        "browser": true,
        "es6": true,
        "node": true
    },
    "extends": [
        "eslint:recommended",
        "plugin:vue/essential",
    ],
    "globals": {
        "Atomics": "readonly",
        "SharedArrayBuffer": "readonly"
    },
    "parserOptions": {
        "ecmaVersion": 2018,
        "sourceType": "module"
    },
    "plugins": [
        "vue",
        'vuetify'
    ],
    rules: {
        /**
         * eslint:recommended
         */
        'no-unused-vars': 'off',
        /**
         * vue:essential
         */
        // 'vue/no-async-in-computed-properties': 'off',

        /**
         * vuetify
         */
        'vuetify/no-deprecated-classes': 'error',
        'vuetify/grid-unknown-attributes': 'error',
        'vuetify/no-legacy-grid': 'error',
    }
};
