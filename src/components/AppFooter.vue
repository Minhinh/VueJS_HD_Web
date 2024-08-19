<template>
      <v-container>
        <v-row>
          <!-- Location Section -->
          <v-col cols="12" md="6" class="text-center">
            <h3 class="black--text mb-4">Location</h3>
            <p>838 Glenferrie Road</p>
            <p>Hawthorn VIC 3122</p>
            <p><a href="mailto:nhatminhtran34@gmail.com">nhatminhtran34@gmail.com</a></p>
            <p><a href="tel:+61394822454">+61 423032755</a></p>
          </v-col>
          <!-- Hours Section -->
          <v-col cols="12" md="6" class="text-center">
            <h3 class="black--text">Opening Hours</h3>
            <p>Tues-Wed <span class="font-italic">3pm-10pm</span></p>
            <p>Thu-Sat <span class="font-italic">12pm-2am</span></p>
            <p>Sun-Mon <span class="font-italic">Closed</span></p>
            <v-card-actions class="justify-center pa-0">
              <v-btn icon>
                <v-icon color="pink">mdi-instagram</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon color="blue">mdi-facebook</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon color="light-blue">mdi-twitter</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon color="red">mdi-pinterest</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon color="green">mdi-google</v-icon>
              </v-btn>
            </v-card-actions>
          </v-col>
        </v-row>
      </v-container>
  </template>
  
  <script>
  export default {
    name: 'AppFooter',
  };
  </script>
 
  
  
  