Vue.component('limit-search', {
    template: `
    <div class="col-md-6">
        <div class="card p-3 chart">
            <div id="limit-search"></div>
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

            var chart = new ApexCharts(document.querySelector("#limit-search"), options);
            chart.render();
        }
    },
    mounted() {
        this.initAnalitycs();
    }
});