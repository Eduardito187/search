var AnalitycsSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10"></div>
    </div>
    `,
    data() {
        return {
            savedAction: false,
            dataPage: null,
            current_page: 1,
            last_page: 1,
            per_page: 0,
            total: 0
        };
    },
    methods: {
        getAllEvent() {
            let self = this;

            window.fetchFontendData('api/event/get-all', 'POST', {pagination : this.current_page}).then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response.data;
                    self.current_page = data.response.current_page;
                    self.last_page = data.response.last_page;
                    self.per_page = data.response.per_page;
                    self.total = data.response.total;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
        this.getAllEvent();
    }
};