var SupportSection = {
    template: `
    <div class="row">
        <div v-if="dataPage != null" class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">Algolia Support Access</h5>
                            <p class="card-text">In order to investigate a bug or improve relevance, it is sometimes useful to grant Algolia support access to the content of your indices.</p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info custom-alert" role="alert">
                                        <i class="bi bi-info-circle"></i> Algolia cannot currently access your account.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="access-level" class="form-label">Access level</label>
                                    <select v-model="dataPage.access_type" class="form-select" id="access-level">
                                        <option value="read">read</option>
                                        <option value="write">write</option>
                                        <option value="admin">admin</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Period</label>
                                    <select v-model="dataPage.period" class="form-select" id="period">
                                        <option value="7">7 days</option>
                                        <option value="14">14 days</option>
                                        <option value="30">30 days</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-end mt-3">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search" :disabled="savedAction" @click="modifySupport">
                                <span>Save</span>
                                <div v-if="savedAction" class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
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
            dataPage: null
        };
    },
    methods: {
        getContactData() {
            let self = this;
            window.fetchFontendData('api/account/team-support', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
        modifySupport() {}
    },
    created() {
        this.getContactData();
    },
    mounted() {
    }
};