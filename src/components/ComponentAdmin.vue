<template>
    <v-container>
      <!-- Login Form -->
      <v-card v-if="!authenticated" class="mx-auto my-5 pa-5" max-width="400">
        <v-card-title class="text-h5">Admin Login</v-card-title>
        <v-card-text class="my-4">
          <v-form @keydown.enter="login">
            <v-text-field v-model="username" label="Username"></v-text-field>
            <v-text-field
              v-model="password"
              :append-icon="showPasswordInPlainText ? 'mdi-eye' : 'mdi-eye-off'"
              :type="showPasswordInPlainText ? 'text' : 'password'"
              name="input-10-1"
              label="Password"
              @click:append="showPasswordInPlainText = !showPasswordInPlainText"
            ></v-text-field>
            <v-alert v-if="errMessage !== ''" color="red" type="error" dense>{{ errMessage }}</v-alert>
            <v-btn @click="login" type="button" color="primary" block>Login</v-btn>
          </v-form>
        </v-card-text>
      </v-card>
  
      <!-- Admin Dashboard -->
      <v-card v-else class="mx-auto my-5 pa-5" max-width="600">
        <v-card-title class="text-h5">Admin Dashboard</v-card-title>
        <v-card-text>
          <AdminDashboard></AdminDashboard>
          <v-btn @click="logout" color="red" class="mt-4" block>Logout</v-btn>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script>
 import AdminDashboard from './AdminDashboard.vue'
 export default {
  name: 'ComponentAdmin',
  components: {
    AdminDashboard
  },
  data() {
    return {
      showPasswordInPlainText: false,
      username:'',
      password:'',
      authenticated: false,
      errMessage:''
    };
  },
  methods: {
    login() {
      fetch('http://localhost/cos30043-HD-Vietnamese/src/resources/api_user.php/', {
        method: 'POST',
        headers: {
          'Content-Type' : 'application/json'
        },
        body: JSON.stringify(this.credential)
      })
      .then(response => response.json())
      .then(data => {
        if (data == null) {
          this.errMessage = 'Invalid credentials. Please try agian.';
        } else {
          this.authenticated = true;
        }
      }) 
      .catch (error => {
        console.error('An error occurred during form validation:', error);
      });
      this.username = '';
      this.password = '';
      },
      logout() {
        this.authenticated = false;
        this.username = '';
        this.password = '';
        this.errMessage = '';
      }
    },
    computed: {
      credential() {
        return {
          username: this.username,
          password: this.password
        };
      }
    }
  };
  </script>
  
  <style scoped>
  .v-card {
    border-radius: 50px;
  }
  .v-btn {
    border-radius: 50px;
  }
  </style>
  