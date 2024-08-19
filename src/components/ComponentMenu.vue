<template>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>Menu</v-card-title>
                    <v-card-subtitle>Select from our delicious options</v-card-subtitle>
                    <v-text-field
                        v-model="searchQuery"
                        append-icon="mdi-magnify"
                        label="Search food"
                        single-line
                        hide-details
                        @input="resetPagination"
                    ></v-text-field>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col
                v-for="item in displayedFood"
                :key="item.id"
                cols="12" sm="6" md="4"
            >
                <v-card max-width="500" class="mx-auto my-2">
                    <v-img class="m-3" height="300" :src="item.image" :alt="item.title"></v-img>
                    <v-card-title class="text-center">{{ item.title }}</v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-pagination
                    v-model="currentPage"
                    :length="pageCount"
                    circle
                ></v-pagination>
            </v-col>
        </v-row>
</template>

<script>
export default {
    name: 'MenuComponent',
    data() {
        return {
            foodItems: [],
            currentPage: 1,
            foodPerPage: 6,
            searchQuery: ''
        };
    },
    mounted() {
        this.fetchFoodItems();
    },
    computed: {
        filteredFoodItems() {
            return this.foodItems.filter(item => 
                item.title.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
        displayedFood() {
            const startIndex = (this.currentPage - 1) * this.foodPerPage;
            const endIndex = startIndex + this.foodPerPage;
            return this.filteredFoodItems.slice(startIndex, endIndex);
        },
        pageCount() {
            return Math.ceil(this.filteredFoodItems.length / this.foodPerPage);
        }
    },
    methods: {
        fetchFoodItems() {
            this.foodItems = require('@/assets/food.json');
        },
    },
}
</script>
