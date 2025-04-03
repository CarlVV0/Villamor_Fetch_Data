<script setup >
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <nav class = "bg-blue-500 py-4 shadow">
        <div class = "flex flex-col justify-between mx-4 py-2 md:flex-row  ">
            <div class = "brand text-xl text-white">CARL STORE</div>
            <div class = "flex-col md:flex-row">
                <Link href="/home" class = "text-yellow-200 mx-3 hover:font-bold">Home</Link>
                <Link href="/products" class = "text-yellow-200 mx-3 hover:font-bold">Products</Link>
                <Link href="/transaction" class = "text-yellow-200 mx-3 hover:font-bold">Transaction</Link>
                <Link href="/faq" class = "text-yellow-200 mx-3 hover:font-bold">FAQ</Link>

            </div>
        </div>
    </nav>
    <slot/>
</template>
