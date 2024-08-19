<template>
  <v-row class="sip" align="center" justify="space-between" no-gutters>
    <!-- Navigation Links -->
    <v-col cols="10">
      <v-tabs v-model="activeTab" align-tabs="center" class="text-center" centered>
        <v-tab to="/">
          <v-icon left>mdi-home</v-icon> Home
        </v-tab>
        <v-tab to="/componentOne">
          <v-icon left>mdi-food</v-icon> Menu
        </v-tab>
        <v-tab to="/componentTwo">
          <v-icon left>mdi-star</v-icon> Reviews
        </v-tab>
        <v-tab to="/componentThree">
          <v-icon left>mdi-book-open-variant</v-icon> Our Story
        </v-tab>
        <v-tab to="/componentFive">
          <v-icon left>mdi-briefcase</v-icon> Careers
        </v-tab>
      </v-tabs>
    </v-col>
    <!-- Admin -->
    <v-col cols="2">
      <v-btn to="/componentFour" outlined color="black" class="text-uppercase">
        <v-icon left>mdi-account-cog</v-icon> Administration
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'AppHeader',
  data() {
    return {
      activeTab: null
    };
  }
};
</script>
<style scoped>
  
  .sip{
    background-color: #fff0d7; /* Replace with your desired background color */
    padding: 10px;
  }
  </style>
  

