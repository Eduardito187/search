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
            <div class="row text-end">
                <p>{{total}} items</p>
            </div>
        </div>
        <div class="row">
            <div v-for="data in dataPage" class="col-md-4 mb-2">
                <div class="card">
                    <img :src="data.preview" class="card-img-top picture-preview-mail" :alt="data.name">
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
                                    <li v-if="current_page > 1" class="page-item" @click="selectedPage(current_page-1)">
                                        <span class="page-link" tabindex="-1">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                        </span>
                                    </li>
                                    <li v-if="(current_page-2) > 0" class="page-item" @click="selectedPage(current_page-2)">
                                        <span class="page-link">{{current_page-2}}</span>
                                    </li>
                                    <li v-if="(current_page-1) > 0" class="page-item" @click="selectedPage(current_page-1)">
                                        <span class="page-link">{{current_page-1}}</span>
                                    </li>
                                    <li class="page-item" @click="selectedPage(current_page)">
                                        <span class="page-link active-page">{{current_page}}</span>
                                    </li>
                                    <li v-if="(current_page+1) <= last_page" class="page-item" @click="selectedPage(current_page+1)">
                                        <span class="page-link">{{current_page+1}}</span>
                                    </li>
                                    <li v-if="(current_page+2) <= last_page" class="page-item" @click="selectedPage(current_page+2)">
                                        <span class="page-link">{{current_page+2}}</span>
                                    </li>
                                    <li v-if="current_page != last_page" class="page-item" @click="selectedPage(current_page+1)">
                                        <span class="page-link">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                        </span>
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
            current_page: 1,
            last_page: 1,
            per_page: 0,
            total: 0
        };
    },
    methods: {
        selectedMail(id) {
            this.$router.push({ name: 'Mail', params: { id: id } });
        },
        createMail() {
            this.$router.push('/create-mail');
        },
        selectedPage(page) {
            if (this.current_page == page) {
                return;
            }

            this.current_page = page;
            this.getAllMails();
        },
        getAllMails() {
            let self = this;

            window.fetchFontendData('api/mailing/all-mail-sender', 'POST', {pagination : this.current_page}).then(data => {
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
        this.getAllMails();
    },
    mounted() {
    },
};