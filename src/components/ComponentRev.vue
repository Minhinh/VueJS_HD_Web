<template>
    <v-card-item>
        <v-card-title>Review</v-card-title>
        <v-card-subtitle>Outdoors, La Terrasse is the place to see and be seen. The sun-soaked outdoor dining area overlooking Glenferrie Road is perfectly positioned to watch the world pass by.</v-card-subtitle>
    </v-card-item>
    <v-card-item class="my-4">
        <v-sheet max-width="800" class="mx-auto">
            <v-form class="border rounded-lg p-5">
                <div class="text-center">
                    <v-rating v-model="rating" empty-icon="mdi-heart-outline" full-icon="mdi-heart" color="#74C69D" hover increments></v-rating>
                </div>
                <v-textarea v-model="description" label="Your review is to help us improve ourselves." variant="outlined"></v-textarea>
                <v-alert v-if="sucMessage !== ''" color="#95D5B2" type="success" title="Thank you for your feedback"
                    :text="sucMessage"></v-alert>
                <v-alert v-if="errMessage !== ''" color="#ffccd5" type="error" title="Please try again"
                    :text="errMessage"></v-alert>
                <v-btn @click="submitForm()" color="primary" type="button" text="Submit" block></v-btn>
            </v-form>
        </v-sheet>
    </v-card-item>
</template>
  
<script>
import '@mdi/font/css/materialdesignicons.css';
import 'bootstrap/dist/css/bootstrap.css';
export default {
    name: 'ComponentTwo',
    data() {
        return {
            rating: null,
            description: '',
            errMessage: '',
            sucMessage: ''
        };
    },
    methods: {
        validate() {
            if (this.rating === null) {
                this.errMessage += "Please give us a rating"
            }
            return this.rating !== null;
        },
        submitForm() {
            if (this.validate()) {
                const apiUrl = 'http://localhost/cos30043-HD-Vietnamese/src/resources/review.php/';
                fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.review)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data successfully posted:', data);
                        // Handle the response data as needed
                    })
                    .catch(error => {
                        console.error('Error posting data:', error);
                        // Handle the error
                    });
                this.sucMessage = "We appreciate your time!"
                this.resetForm();
            }
        },
        resetForm() {
            this.rating = null;
            this.description = '';
            this.errMessage = '';
        }
    },
    computed: {
        review() {
            return {
                rating: this.rating,
                description: this.description
            }
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

  