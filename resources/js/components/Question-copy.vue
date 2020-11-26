<template>
    <div>
        <div class="quiz">
            <h1 class="questionH"><li style="margin-left: 1rem;">{{ zawartoscPytania.tresc }}</li></h1>
            <img class="image" :src="zawartoscPytania.image" alt="">
              <ol style="list-style-type: upper-latin; margin: 0; padding: 0;">
                <div v-bind:key="odpowiedz.id" v-for="odpowiedz in zawartoscPytania.odpowiedzi">
                  <div class="ans" :style="calculateColor(odpowiedz.id)" @click="selectAnswer(odpowiedz.id)">
                        <li><p style="margin: 0; padding: 0; margin-left: 5px;">{{ odpowiedz.tresc }}</p></li>
                  </div>
                 
                </div>
              </ol>   
        </div>
       <div class="watermark"><p >ipies</p></div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                check: " ",
            };
        },
        props: ["zawartoscPytania", 'answered'],
        methods: {
            selectAnswer: function (id) {
              this.check=id;
            },

            sprawdzanie: function () {
                this.$emit('answer', this.check != " " ? this.check : 1)
            },
            calculateColor: function(id) {
              if(this.answered==null){
                  if(this.check==id)  {
                      return "background-color: #0061c9;";
                }
                return " ";
              }
              else if(this.answered.zaznaczana.id==1 && id==this.answered.poprawna.id) {
                return "background-color: #007c02;";
              }
              else if(this.answered.poprawna.id==id) {
                  return "background-color: #007c02;";
                }
              else if(!this.answered.zaznaczana.poprawna && id==this.answered.zaznaczana.id) {
                return "background-color: darkred;";
              }
              
            }
        },
    };

</script>
<style scoped>
    .quiz {
        max-width: 60%;
        margin-left: auto;
        margin-right: auto;
        color: rgb(230, 230, 230);
        background-color: rgb(39, 39, 39);
        padding: 15px;
        padding-bottom: 1.5rem;
    }

    .questionH {
        font-size: 28px;
        max-width: 60vw;
        padding-left: 1vw; 
        padding-top: 1vh;
    }

    .image {
        margin-left: auto;
        margin-right: auto;
        display: block;
        margin-bottom: 1vh;
        max-width: 80%;
        
    }

    .ans {
        margin-top: 1.3rem;
        padding: 5px;
        font-size: 16px;
        padding-top: 0.8rem;
        padding-bottom: 0.7rem;
        padding-left: 2rem;
        border: solid 1px rgb(33, 33, 33);
        background: rgb(33, 33, 33);
        cursor: pointer;
        vertical-align: middle;
    }

    .ans >li {
        padding: 0;
        margin: 0;
    }
    .ans:hover {
        background:rgb(29, 29, 29);
        color: rgb(148, 148, 148);
        border: solid 1px #0061c9;
    }

    /* input {
      margin-top: 0.5vh;
      margin-left: 1vw;
      margin-bottom: 2vh;
  } */
    .watermark  {
      text-align: center;
      padding-top: 1rem;
      color: rgb(77, 77, 77);
    }
</style>
