<template>
    <div class="owl-carousel owl-theme">
        <carousel
            v-if="products && products.length"
            :items="4"
            :autoplay="true"
            :center="false"
            :nav="false"
            :margin="20"
            :rewind="true"
            :responsive="{0:{items:1,nav:!1},600:{items:2,nav:!1},1000:{items:4,nav:!1}}"
        >
            
        <a :href="/product/+product.id+'/'+product.slug" v-for="product in products" :key="product.id">
            <div class="featured-item">
                <!-- PRODUCT IMAGE -->
                <img :src="/storage/+product.image" alt="Item" width="220" height="206" />

                <!-- PRODUCT NAME -->
                <h4>
                    <div v-if="product.name.length > 25 && product.name.length < 45">
                        {{ product.name }}
                    </div>

                    <div v-else-if="product.name.length > 45">
                        {{ shorten(product.name,45) }} ...
                    </div>

                    <div v-else>
                        <br> {{ product.name }} <br>
                    </div>
                </h4>

                <!-- PRODUCT PRICE -->
                <h6>${{ product.price }}.00</h6>

                <p>Reviews ({{ product.reviews.length }})</p>

                <!-- <div v-if="product.reviews.length != 0">
                    <div class="d-flex justify-content-start">
                        <div v-for="reviews in product.reviews.length" :key="reviews.id">
                            <i class="fa fa-star checked"></i>
                        </div>
                    </div>
                </div>
                
                <div v-else>
                    <div class="d-flex justify-content-start">
                        <div v-for="star in stars" :key="star">
                            <i class="fa fa-star gray"></i>
                        </div>
                    </div>
                </div> -->

            </div>
        </a>

        </carousel>
    </div>

</template>

<script>
import carousel from 'vue-owl-carousel';

export default {
        components: { carousel },

        data() {
            return {
                products: [],
                stars: [1,2,3,4,5],
                avg: 0

            }
        },

        mounted() {
            this.loadProducts();
        },

        methods: {
            loadProducts() {
                axios.get('/api/products')
                .then(res => {
                    this.products = res.data;
                }) 
                .catch(err => console.log(err));
            },
            shorten: function(string, len) {
                return string.substring(0, len + string.substring(len - 1).indexOf(' '));
            }
        }
    };
</script>

<style></style
