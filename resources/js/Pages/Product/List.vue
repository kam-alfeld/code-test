<template>
    <Head title="Product List" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Product List
                </h2>

                <Link :href="route('product.create')" class="rounded-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-4">Add New Product</Link>
            </div>
        </template>

        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                <Product v-for="product in products" v-bind:product="product" :token="token"></Product>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Product from "@/Components/Product";

export default {
    name: "List",
    props: ['token'],
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Product
    },
    data() {
        return {
            products: []
        };
    },
    mounted() {
        console.log(this.token)

        axios.get(route('api.product.list'),
            {
                headers: { Authorization: `Bearer ${this.token}` }
            })
            .then(response => {
                this.products = response.data
            })
    }
}
</script>

<style scoped>

</style>
