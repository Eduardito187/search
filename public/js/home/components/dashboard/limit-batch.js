Vue.component('limit-batch', {
    template: `
    <div class="col-md-6 margin-bottom-20">
        <div class="card p-3 chart">
            <div id="limit-batch"></div>
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

            var chart = new ApexCharts(document.querySelector("#limit-batch"), options);
            chart.render();
        }
    },
    mounted() {
        this.initAnalitycs();
    }
});