<template>
    <div>
        <vue-slick-carousel v-bind="settings" :arrows="false" :dots="true" >
            <div id="background-image">
                <div class="top-bar">
                    <p class="text">To jest nasza zajebista strona na której będziecie mogli rozwiazywac testy na doktora. 
                        Znajduja sie tu testy ze wszystkiego w sumie i nauczyciele ębeda was tym tepic a my sie bedziemy smiac</p>
                </div>        
            </div>
            <div id="background-image2">
                <div class="top-bar">
                    <p class="text">To jest nasza zajebista strona na której będziecie mogli rozwiazywac testy na doktora. 
                        Znajduja sie tu testy ze wszystkiego w sumie i nauczyciele ębeda was tym tepic a my sie bedziemy smiac</p>
                </div>        
            </div>
            <div id="background-image3">
                <div class="top-bar">
                    <p class="text">To jest nasza zajebista strona na której będziecie mogli rozwiazywac testy na doktora. 
                        Znajduja sie tu testy ze wszystkiego w sumie i nauczyciele ębeda was tym tepic a my sie bedziemy smiac</p>
                </div>        
            </div>
            <div id="background-image4">
                <div class="top-bar">
                    <p class="text">To jest nasza zajebista strona na której będziecie mogli rozwiazywac testy na doktora. 
                        Znajduja sie tu testy ze wszystkiego w sumie i nauczyciele ębeda was tym tepic a my sie bedziemy smiac</p>
                </div>        
            </div>
        </vue-slick-carousel>
         
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
                "autoplaySpeed": 6000,
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
        height: 90vh;
        background: url("../../images/serwerownia.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }

    #background-image2   {
        height: 90vh;
        background: url("../../images/server.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }

    #background-image3   {
        height: 90vh;
        background: url("../../images/room.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }

    #background-image4   {
        height: 90vh;
        background: url("../../images/kod.jpg") no-repeat center center ;
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
        padding-left:20vw;
        padding-right:20vw;
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
