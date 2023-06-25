module.exports = {
    "compilerOptions": {
        "target": "ESNext",
        "useDefineForClassFields": true,
        "module": "ESNext",
        "moduleResolution": "Node",
        "strict": true,
        "jsx": "preserve",
        "resolveJsonModule": true,
        "isolatedModules": true,
        "allowSyntheticDefaultImports": true,
        // "rootDir": "./",
        // "baseUrl": "./",
        "lib": [
            "ESNext",
            "DOM",
            "dom.iterable",
            "scripthost"
        ],
        "paths": {
            "@/*": "./resources/js/*",
            "@/*": "./resources/ts/*"
        },
        "types": [
            "vite/client"
          ],
        "esModuleInterop": true,
        "forceConsistentCasingInFileNames": true,
        "skipLibCheck": true
    },
    "include": [
        "./resources/js/**/*.js",
        "./resources/ts/**/*.ts",
        "./resources/ts/types/*.ts",
        "./resources/js/**/*.d.ts",
        "./resources/ts/**/*.d.ts",
        "./resources/**/*.tsx",
        "./resources/**/*.vue"
    ],
    "exclude": [
        "node_modules"
    ]
}
