<template>
    <Head title="Cart" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Cart
                </h2>
            </div>
        </template>

        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                <Product v-for="product in products" v-bind:product="product" cart></Product>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Product from "@/Components/Product";
export default {
    name: "Cart",
    components: {
        Product,
        BreezeAuthenticatedLayout,
        Head,
        Link
    },
    data() {
        return {
            products: []
        };
    },
    mounted() {
        axios.get(route('api.product.cart'))
            .then(response => {
                this.products = response.data
            })
    }
}
</script>

<style scoped>

</style>
