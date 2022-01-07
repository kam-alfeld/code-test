<template>
    <Head title="Product List" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Product List
                </h2>

                <Link class="rounded-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-4">Add New Product</Link>
            </div>
        </template>

        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                <div v-for="product in products" class="my-1 px-1 w-full md:w-1/3 lg:my-4 lg:px-4 lg:w-1/4">

                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg">
                        <a href="#">
                            <img alt="Placeholder" class="block h-auto w-full" :src="product.image">
                        </a>

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="#">
                                    {{ product.name }}
                                </a>
                            </h1>
                            <p class="text-lg">
                                ${{ product.price }}
                            </p>
                        </header>

                        <div class="flex text-ellipsis overflow-hidden px-2 md:px-4">
                            {{ product.description }}
                        </div>

                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <a class="flex items-center no-underline hover:underline text-black" href="#">
                                <p class="text-sm">
                                    Created by {{ product.creator.first_name }}
                                </p>
                            </a>
                            <button class="rounded-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-4">Add To Cart</button>
                        </footer>

                    </article>
                    <!-- END Article -->

                </div>
                <!-- END Column -->
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    name: "List",
    components: {
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
        console.log(this.token)

        axios.get(route('api.product.list'))
            .then(response => {
                this.products = response.data
            })
    }
}
</script>

<style scoped>

</style>
