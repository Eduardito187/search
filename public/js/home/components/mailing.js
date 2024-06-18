var MailingSection = {
    template: `
    <div class="row">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row text-end">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search" @click="createMail()">
                                <span>Create Mail</span>
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div v-for="data in dataPage" class="col-md-4 mb-2">
                <div class="card">
                    <img :src="data.preview" class="card-img-top" :alt="data.name">
                    <div class="card-body">
                        <h5 class="card-title">{{data.name}}</h5>
                        <p class="card-text">{{data.description}}</p>
                        <div v-if="data.indexes.length > 0" class="col-12">
                            <span v-for="index in data.indexes" class="badge bg-primary">{{index}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row text-end">
                        <div class="col align-self-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            savedAction: false,
            dataPage: null,
            currentPage: 1
        };
    },
    methods: {
        createMail() {
            this.$router.push('/create-mail');
        },
        getAllMails() {
            let self = this;

            window.fetchFontendData('api/mailing/all-mail-sender', 'POST', {pagination : this.currentPage}).then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response.data;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
        this.getAllMails();
    },
    mounted() {
    },
    updated() {
        this.getAllMails();
    }
};