<template>
    <v-card-title>About Us</v-card-title>
            <v-card-subtitle>
                La Belle Vie Hood
            </v-card-subtitle>
      <!-- Existing About Content centered -->
      <v-card-text class="my-8">
      <v-row class="justify-center">
        <v-col cols="12" md="10">
          <v-card class="elevation-2">
            <v-card-text class="text-center">
              <p>We are passionate about delivering high-quality products and exceptional customer service. Our team is dedicated to sourcing the finest ingredients and crafting them into truly unique products.</p>
              <p>Founded in 2023, our company has grown from a small startup to a leading player in the food industry, maintaining our commitment to sustainability and excellence every step of the way.</p>
              <img src="../assets/pic3.jpeg">
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-card-text>
      <!-- FAQ Section with centered text and items -->
      <v-row class="justify-center">
        <v-col cols="12" md="10">
          <v-card class="elevation-2">
            <v-card-title class="text-center text-h5">Frequently Asked Questions</v-card-title>
            <v-card-subtitle class="text-center">Welcome to our food e-commerce store! We understand that you may have some questions about our products, shipping, and returns...</v-card-subtitle>
            <v-divider class="my-5"></v-divider>
            <v-list>
              <v-list-item-group>
                <v-list-item v-for="(item, index) in faqItems" :key="index" @click="toggle(index)">
                  <v-list-item-content class="d-flex justify-center">
                    <v-container>
                      <v-row>
                        <v-col cols="12">
                          <v-list-item-title class="text-center">{{ item.question }}</v-list-item-title>
                          <v-slide-y-transition>
                            <div v-if="index === activeIndex" class="mt-3 text-center">
                              {{ item.answer }}
                            </div>
                          </v-slide-y-transition>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
  </template>
  
  <script>
  export default {
    name: 'ComponentThree',
    data() {
      return {
        faqItems: [
          {
            question: 'What techonology I used in this project ?',
            answer: 'My project mainly used Bootstrap, Axious, VueJs, and Vuetify. Also, the food are taken from the API online and stored in the json file for better contribution.'
          },
          {
            question: 'What is the functionality of the website ?',
            answer: 'Generate random food of the day, Search Menu, Reviews, and About Us.'
          },
          {
            question: 'What is the location of the restaurant ?',
            answer: 'The address is: 25 Elizabeth St, Melbourne 3000, Victoria.'
          },
          {
            question: 'Do you offer take-away food of the restaurant ?',
            answer: 'Yes, we offer a selection of food in our menu. These are clearly labeled in our store.'
          }
        ],
        activeIndex: null
      };
    },
    methods: {
      toggle(index) {
        this.activeIndex = this.activeIndex === index ? null : index;
      }
    }
  }
  </script>
  