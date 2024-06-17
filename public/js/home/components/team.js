var TeamSection = {
    template: `
    <div class="row member-container">
        <div class="member-section">
            <div class="member-header">Dismac</div>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Member</th>
                        <th scope="col">Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in dataPage">
                        <td>{{data.mail}}</td>
                        <td>
                            <span class="permissions">
                                <span class="badge bg-primary">Set-Up Search</span>
                                <span class="badge bg-primary">Search Features</span>
                                <span class="badge bg-primary">View Search</span>
                                <span class="badge bg-primary">Recommend</span>
                                <span class="badge bg-secondary">Others</span>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    `,
    data() {
        return {
            dataPage: null
        };
    },
    methods: {
        getTeamsData() {
            let self = this;
            window.fetchFontendData('api/account/team-users', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
    },
    created() {
        this.getTeamsData();
    },
    mounted() {
    }
};