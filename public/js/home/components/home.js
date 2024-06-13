var HomeSection = {
    template: `
    <div>
        <div class="jumbotron">
            <h1 class="display-4">Bienvenido!</h1>
            <p class="lead">Comprueba lo que esta sucediendo con tu implementación de EduardSearch.</p>
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

        <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-database" aria-hidden="true"></i> Data
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div class="row mb-40p">
                        <div class="col-md-6 text-start">
                            <div class="row">
                                <small clas="small-title">Registros</small>
                            </div>
                            <div class="row">
                                <span class="detail-description">500K</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-start">
                            <small clas="small-title">Indices</small>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 flex-grow-1 bd-highlight">Index</div>
                                <div class="p-2 bd-highlight">Consultas</div>
                                <div class="p-2 bd-highlight">Registros</div>
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
            dataIndex: null
        };
    },
    methods: {
        initializeCharts(labelName, labelArray, valueArray, itemId) {
            var options = {
                chart: {height: 100,type: "line"},
                colors: ["#FF1654"],
                series: [{name: labelName,data: valueArray}],
                xaxis: {show: false,categories: labelArray,labels: {show: true}},
                stroke: {curve: 'smooth'}
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
                    }, 500);
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
    },
    mounted() {
        this.getDashboardData();
    }
};