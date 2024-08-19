<template>
    <v-row>
      <v-col cols="12">
        <v-card-subtitle>Recent Applications</v-card-subtitle>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" v-for="application in applications" :key="application.id">
        <v-card class="m-4 p-3">
          <v-card-title>Application {{ application.id }}</v-card-title>
          <v-card-text>
            <div>Applicant's name: {{ application.name }}</div>
            <div>Applicant's position: {{ application.position }}</div>
            <div>Applicant's store: {{ application.store }}</div>
            <div>Applicant's contact email: {{ application.email }}</div>
            <div>Applicant's contact phone: {{ application.phone }}</div>
            <div>Applicant's address: {{ application.address }}</div>
            <div>Applicant's description: {{ application.description }}</div>
            <div>Submission date: {{ application.submission_date }}</div>
            <div>
              <a :href="application.resume_link" target="_blank">View Resume</a>
            </div>
            <v-btn @click="delData(application.id)" color="red" class="mt-2">Delete</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-alert v-if="msg" :type="msgType" dismissible class="mt-3">
      {{ msg }}
    </v-alert>
</template>
<script>
import axios from 'axios';
export default {
  name: 'AdminDashboard',
  data() {
    return {
      applications: [],
      msg: '',
      msgType: ''
    };
  },
  mounted() {
    this.fetchApplications();
    this.delData;
  },
  methods: {
    fetchApplications() {
      axios
        .get('http://localhost/cos30043-HD-Vietnamese/src/resources/apply_api.php/')
        .then((response) => {
          this.applications = response.data;
        })
        .catch((error) => {
          console.error('Failed to fetch applications:', error);
        });
    },
    delData(id) {
      const delsql = `http://localhost/cos30043-HD-Vietnamese/src/resources/apply_api.php/id/${id}`;
      axios
      .delete(delsql)
      .then((response) => {
        if (response.status === 200) {
          this.msg = 'Application deleted successfully';
          this.msgType = 'success';
          this.fetchApplications();
        } else {
          this.msg = 'Failed to delete appilication';
          this.msgType = 'error';
        }
      })
      .catch((error) => {
        console.error('Failed to delete application', error);
        this.msg = 'Error deleting application';
        this.msgType = 'error';
      });
    }
  }
};
</script>
<style scoped>
.v-card {
  border-radius: 10px;
}
.v-btn {
  border-radius: 25px;
}
</style>
