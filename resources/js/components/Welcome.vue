<template>
    <div>
        <vue-slick-carousel v-bind="settings" :arrows="false" :dots="true" >
            <div id="background-image">
                <div class="top-bar">
                    <p class="text">To jest nasza zajebista strona na której będziecie mogli rozwiazywac testy na doktora. 
                        Znajduja sie tu testy ze wszystkiego w sumie i nauczyciele ębeda was tym tepic a my sie bedziemy smiac</p>
                </div>        
            </div>
            <div id="background-image">
                <div class="top-bar">
                    <p class="text">To jest nasza zajebista strona na której będziecie mogli rozwiazywac testy na doktora. 
                        Znajduja sie tu testy ze wszystkiego w sumie i nauczyciele ębeda was tym tepic a my sie bedziemy smiac</p>
                </div>        
            </div>
        </vue-slick-carousel>
        <div class="dots"></div>
        <div class="down-bar">
        </div>        
    </div>
</template>
<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
    data(){
        return{
            settings:{
                "autoplay": true,
                "autoplaySpeed": 3000,
                "pauseOnHover": false,
                "lazyLoad": "progressive",
            }
        }
    },
    components: {VueSlickCarousel},
    methods: {

        }

    }

</script>
<style scoped>
    #background-image   {
        background: url("../../images/serwerownia.jpg") no-repeat center center ;
        height: 90vh;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }

    .top-bar {
        padding-top: 2rem;

    }

    .text   {
        margin-left: auto;
        margin-right: auto;
        background-color: rgba(0, 0, 0, 0.7);
        font-size: 2rem; 
        width: 99.5vw;
        padding: 1rem;
        padding-left:25vw;
        padding-right:25vw;
        margin-top: 2rem;
    }
    
    .dots {
        height: 2rem;
        width: 99.5vw;
    }
    .dot{
        top: -1rem;
        font-size: 50px;
    }
</style>
