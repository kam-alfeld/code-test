<template>
    <div class="my-1 px-1 w-full md:w-1/3 lg:my-4 lg:px-4 lg:w-1/4">

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

                    <!--p class="text-grey-darker text-sm">
                        {{ product.created_at}}
                    </p-->
                </h1>
                <p class="text-lg">
                    ${{ product.price }}
                </p>
            </header>

            <div class="flex text-ellipsis overflow-hidden px-2 md:px-4">
                {{ product.description.length > 200 ? product.description.substr(0, 200) + " ..." : product.description }}
            </div>

            <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                <a class="flex items-center no-underline hover:underline text-black" href="#">
                    <p class="text-sm">
                        Created by {{ product.creator.first_name + " " + product.creator.last_name }}
                    </p>
                </a>
                <button v-if="!cart" class="rounded-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-4" @click="attachProduct">Add To Cart</button>
            </footer>

        </article>
        <!-- END Article -->

    </div>
    <!-- END Column -->
</template>

<script>
export default {
    name: "Product",
    props: {
        product: Object,
        cart: Boolean,
        token: String
    },
    methods: {
        attachProduct() {
            axios.post(route('api.product.attach', this.product.id),
                {

                },
                {
                    headers: { Authorization: `Bearer ${this.token}` }
                })
                .then(response => {
                    console.log(response.data)
                    alert("Successfully added to cart")
                })
        }
    }
}
</script>

<style scoped>

</style>
