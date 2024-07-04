var DashboardSection = {
    template: `
    <div class="container-dashboard">
        <record-search></record-search>
        <div class="row mb-4">
            <limit-search></limit-search>
            <limit-batch></limit-batch>
        </div>
        <div class="row mb-4">
            <detail-usage-search></detail-usage-search>
            <detail-usage-batch></detail-usage-batch>
        </div>
        <div class="row mb-4">
            <div class="col-md-6 margin-bottom-20">
                <div class="card p-3 chart">
                    <div id="lineChart"></div>
                </div>
            </div>
            <div class="col-md-6 margin-bottom-20">
                <div class="card p-3 chart">
                    <div id="doughnutChartV2"></div>
                </div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
        };
    },
    methods: {
        initializeCharts() {
            var options = {
                series: [{
                    name: 'series1',
                    data: [31, 40, 28, 51, 42, 109, 100]
                }, {
                    name: 'series2',
                    data: [11, 32, 45, 32, 34, 52, 41]
                }],
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#lineChart"), options);
            chart.render();

            var options = {
                series: [70],
                chart: {
                    height: '300px',
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '70%',
                        }
                    },
                },
                labels: ['Cricket'],
            };

            var chart = new ApexCharts(document.querySelector("#doughnutChartV2"), options);
            chart.render();
        },
    },
    created() {
        this.getDashboardData();
    },
    mounted() {
        this.initializeCharts();
    }
};