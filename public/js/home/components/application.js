var ApplicationSection = {
    template: `
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row text-end">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search">
                                <span>Nuevo</span>
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">App</th>
                        <th scope="col">Code</th>
                        <th scope="col">Index</th>
                        <th scope="col">Search</th>
                        <th scope="col">Record</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in dataPage">
                        <td>{{data.app}}</td>
                        <td>{{data.code}}</td>
                        <td>{{data.index}}</td>
                        <td>{{data.search}}</td>
                        <td>{{data.record}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    `,
    data() {
        return {
            dataPage: []
        };
    },
    methods: {
        getDataPage() {
            let self = this;
            window.fetchFontendData('api/account/aplication-data', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
        this.getDataPage();
    },
    mounted() {
    }
};