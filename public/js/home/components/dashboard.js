var DashboardSection = {
    template: `
    <div class="container-dashboard">
        <div class="row mb-4">
            <div class="container-row">
                <div class="card p-3 chart-large">
                    <div id="barChart"></div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="container-row">
                <div class="card p-3 chart-large">
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>
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
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                    name: 'Free Cash Flow',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#barChart"), options);
            chart.render();

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