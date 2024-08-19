<template>
    <v-app id="app">
      <AppHeader ></AppHeader>
      <v-main>
        <v-card class="p-3">
          <!-- custom component views -->
          <router-view></router-view>
        </v-card>
      </v-main>
      <v-footer class="my-3 rounded elevation-1">
        <AppFooter></AppFooter>   
      </v-footer>
    </v-app>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';

export default {
  components: {
    AppHeader,
    AppFooter
  },
};
</script>
<style scoped>
.v-footer{
  background-color: #fff0d7;
}
</style>



