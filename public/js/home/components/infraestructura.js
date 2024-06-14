var InfraestructuraSection = {
    template: `
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Search</th>
                        <th scope="col">Record</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Santa Cruz</td>
                        <td>scz</td>
                        <td>6M</td>
                        <td>500K</td>
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
            window.fetchFontendData('api/account/infraestructure-data', 'POST').then(data => {
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
