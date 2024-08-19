<template>
    <v-card-title>Careers</v-card-title>
    <v-card-subtitle>Join our team at La Belle Vie Hood</v-card-subtitle>
    <v-card-text>
      <v-sheet max-width="1000" class="mx-auto">
        <v-row class="justify-center">
          <v-col cols="12" >
            <v-form class="border elevation-4 rounded-lg pa-5">
              <v-text-field
                v-model="name"
                label="Your Name"
                outlined
                dense
                :error-messages="errors.name"
              ></v-text-field>
              <v-select
                v-model="position"
                :items="positions"
                label="Choose Position"
                outlined
                dense
                :error-messages="errors.position"
              ></v-select>
              <v-select
                v-model="store"
                :items="stores"
                label="Our locations"
                outlined
                dense
                :error-messages="errors.store"
              ></v-select>
              <v-text-field
                v-model="email"
                label="Email Address"
                outlined
                dense
                :error-messages="errors.email"
              ></v-text-field>
              <v-text-field
                v-model="phone"
                label="Phone Number"
                outlined
                dense
                :error-messages="errors.phone"
              ></v-text-field>
              <v-text-field
                v-model="address"
                label="Your Address"
                outlined
                dense
                :error-messages="errors.address"
              ></v-text-field>
              <v-textarea
                v-model="description"
                label="Describe about yourself"
                outlined
                dense
                :error-messages="errors.description"
              ></v-textarea>
              <v-file-input
                v-model="resumeFile"
                label="Upload Your Resume"
                accept=".pdf"
                outlined
                dense
              ></v-file-input>
              <v-alert color="green lighten-4" dark v-if="sucMessage !== ''" type="success" title="Completed" :text="sucMessage"></v-alert>
              <v-btn @click="submit" type="button" color="primary" class="mt-4" block>Submit Application</v-btn>
              <v-btn @click="resetForm" type="reset" color="secondary" class="mt-2" block>Reset</v-btn>
            </v-form>
          </v-col>
        </v-row>
      </v-sheet>
    </v-card-text>

</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';

export default {
  name: 'ComponentThree',
  data() {
    return {
      name: '',
      position: '',
      positions: ['Part-Time', 'Casual', 'Full-Time'],
      store: '',
      stores: [
        'CBD - Melbourne',
        'Camberwell - Melbourne',
        'Boxhill - Melbourne',
        'Hawthorn - Melbourne',
        'Toorak - Melbourne',
        'Caulfield - Melbourne',
        'Footscray - Melbourne',
        'Dandenong - Melbourne',
        'Noble Park - Melbourne',
        'Springvale - Melbourne',
      ],
      email: '',
      phone: '',
      address: '',
      description: '',
      resumeFile: '',
      errors: {
        name: '',
        position: '',
        store: '',
        email: '',
        phone: '',
        address: '',
        description: ''
      },
      sucMessage: ''
    };
  },
  methods: {
    validateForm() {
      let valid = true;
      // Reset errors
      this.errors = { name: '', position: '', store: '', email: '', phone: '', address: '', description: '' };

      if (!this.name) {
        this.errors.name = 'Name is required.';
        valid = false;
      }
      if (!this.position) {
        this.errors.position = 'Position is required.';
        valid = false;
      }
      if (!this.store) {
        this.errors.store = 'Store selection is required.';
        valid = false;
      }
      if (!this.email) {
        this.errors.email = 'Email is required.';
        valid = false;
      } else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(this.email)) {
        this.errors.email = 'Invalid Email address.';
        valid = false;
      }
      if (!this.phone) {
        this.errors.phone = 'Phone number is required.';
        valid = false;
      } else if (!/^\d{10}$/.test(this.phone)) {
        this.errors.phone = 'Invalid phone number. Please enter a 10-digit number.';
        valid = false;
      }
      return valid;
    },

    submit() {
      if (this.validateForm()) {
        const apiUrl = 'http://localhost/cos30043-HD-Vietnamese/src/resources/apply_api.php/';
        fetch(apiUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.application)
        })
          .then(response => response.json())
          .then(data => {
            console.log('Data successfully posted:', data);
            this.sucMessage = "Your registration has been submitted. We will catch you up soon!";
            this.resetForm();
          })
          .catch(error => {
            console.error('Error posting data:', error);
          });
      }
    },
    resetForm() {
      this.name = '';
      this.position = '';
      this.store = '';
      this.email = '';
      this.phone = '';
      this.address = '';
      this.description = '';
      this.resumeFile = null;
      this.errors = { name: '', position: '', store: '', email: '', phone: '', address: '', description: '' };
    }
  },
  computed: {
    application() {
      return {
        name: this.name,
        position: this.position,
        store: this.store,
        email: this.email,
        phone: this.phone,
        address: this.address,
        description: this.description
      };
    }
  }
};
</script>

<style scoped>
.v-form {
  background-color: #fff0d7;
}
.v-btn {
  border-radius: 25px;
}
</style>
