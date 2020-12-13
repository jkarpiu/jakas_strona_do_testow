<template>
    <div>
        <div class="logoszew">
            <div class="logos">
                <h1>ipies</h1>
            </div>
        </div>
        <vue-slick-carousel v-bind="settings" :arrows="false" :dots="true" >
            <div id="background-image">
                <div class="top-bar">
                    <p class="text">Na naszej stronie możesz rozwiązywać testy związane z IT. Oferujemy bogatą w pytania bazę danych, która składa się z arkuszy egzaminacyjnych z poprzednich lat.</p>
                </div>  
                <div class="logoszew">
                <a @click="$router.push('/losowanie40')">
                <div class="przycisk" @click="test">
                    ROZWIĄŻ TEST
                </div>
                </a>      
                </div>

            </div>
            <div id="background-image2">
                <div class="top-bar">
                    <p class="text">Możesz wykorzystać możliwość zakładania klas, tworzenia pytań i własnych testów. Ustal ich termin, ilość pytań i integruj się ze swoją klasą.</p>
                </div>
                <div class="logoszew">
                <a @click="$router.push('/groups')">
                <div class="przycisk">
                    KLASY
                </div>
                </a>     
                </div>        
            </div>
            <div id="background-image3">
                <div class="top-bar">
                    <p class="text">Sprawdź swój postęp w rozwiązywaniu testów gdy już masz swoje konto - bez pracy nie ma kołaczy.</p>
                </div>
                <div class="logoszew">
                <a @click="$router.push('user/wyniki')">
                <div class="przycisk">
                    WYNIKI
                </div>
                </a>    
                </div>
            </div>
            <div id="background-image4">
                <div class="top-bar">
                    <p class="text">Załóż konto na ipies - jako nauczyciel lub uczeń. Dzięki temu możesz uporządkować swoją organizację pracy.</p>
                </div>   
                <div class="logoszew">
                    <div class="logoszew2">
                        <a @click="$router.push('/login')" >
                        <div class="przycisk">
                            LOGOWANIE
                        </div>
                        </a>  
                        <a @click="$router.push('/register')">
                        <div  class="przycisk">
                            REJESTRACJA
                        </div>
                        </a>  
                    </div>
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
        test: function(){
            console.log("DD");
        }
        }

    }

</script>
<style scoped>
    #background-image   {
        height: 91vh;
        background: url("../../images/serwerownia.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
        
    }

    #background-image2   {
        height: 91vh;
        background: url("../../images/server.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }

    #background-image3   {
        height: 91vh;
        background: url("../../images/room.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }

    #background-image4   {
        height: 91vh;
        background: url("../../images/kod.jpg") no-repeat center center ;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        position: relative;   
    }
    
    .top-bar {
        padding-top: 9rem;

    }

    .text   {
        margin-left: auto;
        margin-right: auto;
        background-color: rgba(0, 0, 0, 0.664);
        font-size: 1.7rem; 
        width: 99.5vw;
        padding: 1rem;
        padding-left:20vw;
        padding-right:20vw;
        margin-top: 2rem;
        text-align: center;
    }
    
    .dots {
        height: 2rem;
        width: 99.5vw;
    }
    .dot{
        top: -1rem;
        font-size: 50px;
    }
    .logos{
        margin-top:4vh;
        display:flex;
        align-items: center;
        text-align: center;
        background: #0061c9;
        justify-content: center;
		position: absolute;
        padding:0.7rem 2.4rem;
        z-index: 1;
        -webkit-box-shadow: 2px 2px 16px 1px rgba(0,0,0,0.6); 
        box-shadow: 2px 2px 16px 1px rgba(0,0,0,0.6);
    }
    .logoszew{
        min-width: 50vw;
        display: flex; 
        justify-content: center;
    }
    .logoszew2{
        max-width:40vw;
        min-width: 40vw;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: stretch;
        align-content: center;
    }
    
    .logos h1{
        font-size: 3.5rem;
    }
    .przycisk{
        font-size: 1.5rem;
        margin-top:8vh;
        align-items: center;
        text-align: center;
        background: #407ec0;
        justify-content: space-around;
        padding:1rem 3rem;
        z-index: 1;
        -webkit-box-shadow: 2px 2px 12px 1px rgba(0,0,0,0.6); 
        box-shadow: 2px 2px 12px 1px rgba(0,0,0,0.6); 
        cursor: pointer;
    }
    .przycisk :hover{
        border: 1px solid blue;
        background-color: chartreuse;

    }
    .przycisk p{
        margin:0;
        padding:0;
    }
</style>
