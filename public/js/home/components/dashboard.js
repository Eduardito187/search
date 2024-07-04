var DashboardSection = {
    template: `
    <div class="container-dashboard">
        <record-search></record-search>
        <usage-operations-search></usage-operations-search>
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
        },
    },
    created() {
        this.getDashboardData();
    },
    mounted() {
        this.initializeCharts();
    }
};