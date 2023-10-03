<template>
    <h1>{{ greetingMessage }}</h1>
    
    </template>
    
    
    <script>
    export default {
        name: 'exemple',
        props: {
            greetingMessage: {
                type: String,
                default: 'gg la team'
            }
        }
    };
    </script>
    
    
    <style>
    h1 {
        color: blue;
    }
    </style>
    
    