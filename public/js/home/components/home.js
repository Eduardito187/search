var HomeSection = {
    template: `
    <div>
        <div class="jumbotron">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img class="picture-app-home" :src="logoApp" alt="Eduard Search">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h2 class="display-4">Bienvenido!</h2>
                    <p class="lead">Comprueba lo que esta sucediendo con tu implementación de EduardSearch.</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="mb-4"></div>
        </div>

        <div v-if="queryData != null" class="card mb-4">
            <div class="card-header">
                <i class="fa fa-search" aria-hidden="true"></i> Busquedas
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div v-if="queryData.counter" class="row mb-40p">
                        <div class="col-md-6 text-start">
                            <div class="row mt-4">
                                <small clas="small-title">Solicitudes de busquedas</small>
                            </div>
                            <div class="row">
                                <span class="detail-description">{{queryData.counter.value}}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="content-chart-eduard-search" id="chart-query-counter"></div>
                        </div>
                    </div>
                    <hr>
                    <div v-if="queryData.time" class="row mb-40p">
                        <div class="col-md-6 text-start">
                            <div class="row">
                                <small clas="small-title">Tiempo de procesamiento</small>
                            </div>
                            <div class="row">
                                <span class="detail-description">{{queryData.time.value}}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="content-chart-eduard-search" id="chart-time-counter"></div>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>

        <div v-if="suggestionData != null" class="card mb-4">
            <div class="card-header">
                <i class="fa fa-list" aria-hidden="true"></i> Sugeridos
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div v-if="suggestionData.counter != null" class="row mb-40p">
                        <div class="col-md-6 text-start">
                            <div class="row">
                                <small clas="small-title">Productos sugeridos</small>
                            </div>
                            <div class="row">
                                <span class="detail-description">{{suggestionData.counter.value}}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="content-chart-eduard-search" id="chart-suggestion-counter"></div>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>

        <div v-if="dataIndex != null" class="card mb-4">
            <div class="card-header">
                <i class="fa fa-database" aria-hidden="true"></i> Data
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div v-if="dataIndex.counter != null" class="row mb-40p">
                        <div class="col-md-6 text-start">
                            <div class="row">
                                <small clas="small-title">Registros</small>
                            </div>
                            <div class="row">
                                <span class="detail-description">{{dataIndex.counter.value}}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="content-chart-eduard-search" id="chart-data-counter"></div>
                        </div>
                    </div>
                    <hr v-if="dataIndex.index != null">
                    <div v-if="dataIndex.index != null" class="row">
                        <div class="col-md-12 text-start">
                            <small clas="small-title">Indices</small>
                        </div>
                        <div class="col-md-12">
                            <div class="col-12 d-flex bd-highlight">
                                <div class="col-8 pl-5 bd-highlight">
                                    <small clas="small-title">Index</small>
                                </div>
                                <div class="col-2 bd-highlight text-center">
                                    <small clas="small-title">Consultas</small>
                                </div>
                                <div class="col-2 bd-highlight text-center">
                                    <small clas="small-title">Registros</small>
                                </div>
                            </div>
                            <div v-for="data in dataIndex.index" class="col-12 d-flex">
                                <div class="col-8 pl-5">
                                    <small clas="small-title">{{data.code}}</small>
                                </div>
                                <div class="col-2 pl-5 text-center">
                                    <small clas="small-title">{{data.query}}</small>
                                </div>
                                <div class="col-2 pl-5 text-center">
                                    <small clas="small-title">{{data.record}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            queryData: null,
            suggestionData: null,
            dataIndex: null,
            logoApp: '',
        };
    },
    methods: {
        initializeCharts(labelName, labelArray, valueArray, itemId) {
            let auxLabel = [];

            for (let index = 0; index < labelArray.length; index++) {
                auxLabel.push(index);
            }

            var options = {
                chart: {height: 100,type: "line",stacked: false},
                colors: ["#FF1654"],
                series: [{name: labelName,data: valueArray}],
                xaxis: {categories: auxLabel},
                yaxis: [{axisTicks: {show: true},axisBorder: {show: true,color: "#FF1654"},labels: {style: {colors: "#FF1654"}}}],
                tooltip: {shared: false,intersect: true,x: {show: false}}
            };
            var chart = new ApexCharts(document.querySelector(itemId), options);
            chart.render();
        },
        getDashboardData() {
            let self = this;
            window.fetchFontendData('api/account/dashboard-data', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.queryData = data.response.query;
                    self.suggestionData = data.response.suggestion;
                    self.dataIndex = data.response.data;

                    setTimeout(function () {
                        self.initializeCharts("Solicitudes", self.queryData.counter.label, self.queryData.counter.data, "#chart-query-counter");
                        self.initializeCharts("Tiempo", self.queryData.time.label, self.queryData.time.data, "#chart-time-counter");
                        self.initializeCharts("Sugeridos", self.suggestionData.counter.label, self.suggestionData.counter.data, "#chart-suggestion-counter");
                        self.initializeCharts("Data", self.dataIndex.counter.label, self.dataIndex.counter.data, "#chart-data-counter");
                    }, 1000);
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
        this.logoApp = window.configFrontend.base_url_frontend+'img/picture-logo.png';
    },
    mounted() {
        this.getDashboardData();
    }
};