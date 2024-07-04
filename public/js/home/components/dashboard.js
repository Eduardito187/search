var DashboardSection = {
    template: `
    <div class="container-dashboard">
        <record-search></record-search>
        <div class="row mb-4">
            <div class="container-row">
                <div class="card p-3 chart-large">
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <limit-search></limit-search>
            <limit-batch></limit-batch>
        </div>
        <div class="row mb-4">
            <detail-usage-search></detail-usage-search>
            <detail-usage-batch></detail-usage-batch>
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
                }
            };

            var chart = new ApexCharts(document.querySelector("#lineChart"), options);
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