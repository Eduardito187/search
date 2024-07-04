Vue.component('detail-usage-search', {
    template: `
    <div class="col-md-6">
        <div class="card p-3 chart">
            <div id="detail-usage-search"></div>
        </div>
    </div>
    `,
    props: {
        items: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            activeSection: '',
        };
    },
    methods: {
        initAnalitycs() {
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

            var chart = new ApexCharts(document.querySelector("#detail-usage-search"), options);
        }
    },
    mounted() {
        this.initAnalitycs();
    }
});