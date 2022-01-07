<template>
    <Head title="New Product" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    New Product
                </h2>
            </div>
        </template>

        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="w-full w-1/2 mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <BreezeLabel for="name" value="Name" />
                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="name" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="price" value="Price" />
                    <BreezeInput id="price" type="number" class="mt-1 block w-full" v-model="price" required autofocus autocomplete="price" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="description" value="Description" />
                    <TextArea id="description" class="mt-1 block w-full" v-model="description" required></TextArea>
                </div>

                <div class="mt-4">
                    <label class="inline-block mb-2 text-gray-500">Upload Image(jpg,png,svg,jpeg)</label>
                    <div class="relative inset-0">
                        <img v-if="image" class="w-full" :src="image">
                        <div v-else class="flex items-center justify-center w-full">
                            <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                <div class="flex flex-col items-center justify-center pt-7">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                              clip-rule="evenodd" />
                                    </svg>
                                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                        Select a photo</p>
                                </div>
                                <input type="file" ref="fileInput" @input="previewImage" class="opacity-0" />
                            </label>
                        </div>
                    </div>
                </div>

                <button class="rounded-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 mt-4" @click="createProduct">Submit</button>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import Button from "@/Components/Button";
import TextArea from "@/Components/TextArea";
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    name: "Create",
    props: ['token'],
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        BreezeInput,
        BreezeLabel,
        TextArea,
        Button
    },
    data() {
        return {
            name: '',
            description: '',
            price: 0,
            image: null
        }
    },
    methods: {
        previewImage() {
            let input = this.$refs.fileInput
            if (input.files && input.files[0]) {
                let reader = new FileReader()
                reader.onload = e => {
                    this.image = e.target.result
                }
                reader.readAsDataURL(input.files[0])
                this.$emit('input', input.files[0])
            }
        },
        createProduct() {
            axios.post(route('api.product.create'),
                {
                    name: this.name,
                    description: this.description,
                    price: this.price,
                    image: this.image,
                })
                .then(response => {
                    console.log(response.data)
                    alert("Successfully created");
                })
        }
    }
}
</script>

<style scoped>

</style>
