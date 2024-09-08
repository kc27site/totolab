<template>
    <header>
        <h1>totolab</h1>
    </header>

    <slot></slot>
    <footer>
        <p>
            &copy; {{ new Date().getFullYear() }} totolab. All Rights Reserved.
        </p>
    </footer>
</template>

<script></script>

<style scoped>
header {
    background-color: #e6e6fa;
    color: #333333;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 100%;
}
h1 {
    color: #663399;
    font-size: 2em;
    font-weight: bold;
}
footer {
    background-color: #e6e6fa;
    color: #333333;
    text-align: center;
    padding: 20px;
    width: 100%;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    margin-top: auto;
}
</style>
