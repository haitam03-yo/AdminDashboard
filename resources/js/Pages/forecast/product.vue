<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sales Quantity Forecasting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
        <a :href="route('home')">Home</a>
    </li>
                        <li class="breadcrumb-item"><Link :href="route('home')">Home</Link></li>
                        <li class="breadcrumb-item active">Sales Quantity Forecasting</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Features Selection</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Day Time Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Day Time</label>
                                <select id="dayTime" v-model="selectedDayTime" class="form-control">
                                    <option v-for="dayTime in dayTimeOptions" :key="dayTime" :value="dayTime">
                                        {{ dayTime }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Region Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Region</label>
                                <select id="region" v-model="selectedRegion" class="form-control">
                                    <option v-for="region in regionOptions" :key="region" :value="region">
                                        {{ region }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Weather Dropdown -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Weather</label>
                                <select id="weather" v-model="selectedWeather" class="form-control">
                                    <option v-for="weather in weatherOptions" :key="weather" :value="weather">
                                        {{ weather }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Forecast Period Dropdown -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="forecastPeriod">Select Forecast Period:</label>
                                <select id="forecastPeriod" v-model="selectedForecastPeriod" class="form-control">
                                    <option v-for="period in forecastPeriods" :key="period.value" :value="period.value">
                                        {{ period.label }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Product Dropdown -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="productSelect">Select Product:</label>
                                <select id="productSelect" v-model="selectedProduct" class="form-control">
                                    <option v-for="product in products_id" :key="product" :value="product">
                                        {{ product }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button @click="sendApiRequest" class="btn btn-primary" :disabled="isLoading">Send Request</button>
                    <span v-if="isLoading" class="ml-2">Loading...</span>
                    <div v-if="errorMessage" class="mt-2 text-danger">{{ errorMessage }}</div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
    import { Link } from '@inertiajs/vue3'
</script>


<script>


import axios from 'axios';

export default {
    props: {
        products_id: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            forecastPeriods: [
                { label: 'Next 7 days', value: 7 },
                { label: 'Next 15 days', value: 15 },
                { label: 'Next 30 days', value: 30 },
            ],
            selectedForecastPeriod: 7,
            dayTimeOptions: [],
            regionOptions: [],
            weatherOptions: [],
            selectedDayTime: 'Soirée',
            selectedRegion: 'Urbain',
            selectedWeather: 'Neigeux',
            selectedProduct: 'ALI-012022-020',
            productDetails: null,
            currentDate: new Date().toISOString(),
            isLoading: false,
            errorMessage: null,
        };
    },
    created() {
        this.fetchOptions();
        this.fetchProductDetails();
    },
    mounted() {
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    },
    watch: {
        selectedProduct(newId) {
            this.fetchProductDetails(newId);
        }
    },
    methods: {
        async fetchOptions() {
            try {
                const [weatherResponse, daytimeResponse, regionResponse] = await Promise.all([
                    axios.get('/weather-options'),
                    axios.get('/daytime-options'),
                    axios.get('/region-options'),
                ]);
                this.weatherOptions = weatherResponse.data;
                this.dayTimeOptions = daytimeResponse.data;
                this.regionOptions = regionResponse.data;
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },

        async fetchProductDetails(productId = this.selectedProduct) {
            try {
                const response = await axios.get(`/product/${productId}`);
                this.productDetails = response.data;
                console.log('Product details fetched:', this.productDetails);
            } catch (error) {
                console.error('Error fetching product details:', error);
                this.errorMessage = "Failed to fetch product details.";
            }
        },

        async sendApiRequest() {
            this.isLoading = true;
            this.errorMessage = null;

            // Ensure product details are available before sending request
            if (!this.productDetails) {
                this.errorMessage = "Product details are not available.";
                this.isLoading = false;
                return;
            }

            // Log the request payload to check structure
            const payload = {
                id_produit: this.productDetails.id,
    prix_unitaire: this.productDetails.prix_unitaire,
    marque: this.productDetails.marque,
    categorie: this.productDetails.categorie,
    stock_disponible: this.productDetails.stock_disponible,
    promotion: this.productDetails.promotion,
    date: this.currentDate.slice(0, 10),
    moment_journee: this.selectedDayTime,
    region: this.selectedRegion,
    condition_meteo: this.selectedWeather,
    forecast_period: this.selectedForecastPeriod,
}
;

            console.log('Sending API request with data:', payload);

            try {
                const response = await axios.post('http://127.0.0.1:5000/api/v1/ml/predict_sales', payload, {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });

                // Handle successful response
                console.log('API Response:', response.data);
            } catch (error) {
                // Handle error response
                console.error('Error sending API request:', error);
                this.errorMessage = error.response?.data?.detail || "Failed to send API request.";
            } finally {
                this.isLoading = false;
            }
        }
    },
};
</script>

<style scoped>
/* You can add any custom styles here */
</style>
