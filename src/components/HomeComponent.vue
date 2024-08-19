<template>
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <v-card class="sip my-3 p-3">
            <v-card-title class="text-h5">La Belle Vie Hood</v-card-title>
            <v-card-subtitle>A piece of Paris in the heart of Glenferrie, Hawthorn</v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
      <!-- Top Section with Image and Text -->
      <v-row no-gutters>
        <v-col cols="12">
          <v-img
            src="https://images.pexels.com/photos/1267320/pexels-photo-1267320.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
            aspect-ratio="16/9"
            cover
          >
            <v-container class="fill-height d-flex align-center justify-center">
              <h1 class="white--text" style="font-family: 'Times New Roman', Times, serif; font-size: 60px;">La Belle Vie Hood</h1>
            </v-container>
          </v-img>
        </v-col>
      </v-row>
      <!-- Dishes of the Day -->
    <v-card>
      <v-row>
        <v-col cols="12">
          <v-card-title class="text-center" style="font-size:30px">Dishes of the Day</v-card-title>
          <v-row justify="center">
            <v-col v-for="food in randomFoods" :key="food.id" cols="12" sm="4">
              <v-card>
                <v-img class="m-3" :src="food.image" :alt="`Image of ${food.name}`"></v-img>
                <v-card-title class="text-center">{{ food.title }}</v-card-title>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <v-row class="sip text-center my-5">
        <v-col cols="12"> 
          <h2 class="font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">Sip and Savour</h2>
          <p>Sip on a delicious (and extensive) range of local and international fine wines while you dine inside or people watch from La Terrasse.</p>
          <p>Savour a full French-inspired menu from lunch to dinner – whether a dining experience, afternoon graze or casual meal.</p>
          <v-btn to="/componentOne"  outlined color="black" class="text-uppercase">Menu</v-btn>
        </v-col>
      </v-row>
      </v-card>
      <!-- Sip and Savour Section -->
      <!-- Reviews -->
      <v-row>
        <v-col cols="12">
          <v-card flat>
            <v-card-title>Reviews from Our Valued Customers</v-card-title>
            <v-sheet>
              <v-card-item v-if="loading">
                <v-progress-circular indeterminate color="#74C69D"></v-progress-circular>
              </v-card-item>
              <v-card-item v-else-if="error">
                <span class="red--text">{{ errorMessage }}</span>
              </v-card-item>
              <v-card v-for="(review, index) in displayedReviews" :key="index" class="m-4">
                <v-rating v-model="review.rating" empty-icon="mdi-heart-outline" full-icon="mdi-heart" color="#74C69D" readonly></v-rating>
                <v-card-text>{{ review.description }}</v-card-text>
              </v-card>
              <v-pagination v-model="currentPage" :length="totalPages" @input="paginateReviews"></v-pagination>
            </v-sheet>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'HomeComponent',
    data() {
      return {
        randomFoods: [],
        loading: true,
        reviews: [],
        currentPage: 1,
        reviewsPerPage: 2,
        error: false,
        errorMessage: ''
      };
    },
    mounted() {
      this.initData();
    },
    computed: {
      displayedReviews() {
        const startIndex = (this.currentPage - 1) * this.reviewsPerPage;
        const endIndex = startIndex + this.reviewsPerPage;
        return this.reviews.slice(startIndex, endIndex);
      },
      totalPages() {
        return Math.ceil(this.reviews.length / this.reviewsPerPage);
      }
    },
    methods: {
      async initData() {
        await this.loadFoods();
        this.generateRandomFoods();
        await this.loadReviews();
      },
      async loadFoods() {
        try {
          this.randomFoods = require('@/assets/food.json');
        } catch (error) {
          console.error('Failed to load food items:', error);
          this.error = true;
          this.errorMessage = 'Failed to load dishes.';
        }
      },
      async loadReviews() {
        try {
          const response = await axios.get('http://localhost/cos30043-HD-Vietnamese/src/resources/review.php/');
          this.reviews = response.data.reverse();
          this.loading = false;
        } catch (error) {
          console.error('Failed to load reviews', error);
          this.loading = false;
          this.error = true;
          this.errorMessage = 'Failed to load reviews';
        }
      },
      paginateReviews(page) {
        this.currentPage = page;
      },
      generateRandomFoods() {
        let availableIndices = Array.from(this.randomFoods.keys());
        this.randomFoods = Array.from({ length: 3 }, () => this.randomFoods[availableIndices.splice(Math.floor(Math.random() * availableIndices.length), 1)[0]]);
      }
    },
  };
  </script>
  <style scoped>
  
  .sip{
    background-color: #fff0d7; 
    padding: 80px;
  }
  </style>
  