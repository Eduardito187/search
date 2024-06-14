var ApplicationSection = {
    template: `
    <div class="row">
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
                    <tr>
                        <td>Dismac</td>
                        <td>Dismac</td>
                        <td>6</td>
                        <td>13M</td>
                        <td>1M</td>
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