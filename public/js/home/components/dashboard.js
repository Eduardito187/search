var DashboardSection = {
    template: `
    <div class="container-dashboard">
        <record-search></record-search>
        <div class="row mb-4">
            <div class="col-md-6 margin-bottom-20">
                <div class="card p-3 chart">
                    <div id="doughnutChart"></div>
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
                series: [44, 55, 13, 43, 22],
                chart: {
                    height: '300px',
                    type: 'pie',
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#doughnutChart"), options);
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