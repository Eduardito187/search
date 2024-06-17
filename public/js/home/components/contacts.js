var ContactsSection = {
    template: `
    <div class="row">
        <div v-if="dataPage !0 null" class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">Data Privacy</h5>
                            <p class="card-text">Who should we contact regarding data & privacy matters?</p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="access-level" class="form-label">Data Privacy Officer name</label>
                                    <input type="text" v-model="dataPage.name_privacy" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Phone number</label>
                                    <input type="text" v-model="dataPage.phone_privacy" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="access-level" class="form-label">Mails</label>
                                    <input type="text" v-model="dataPage.mail_privacy" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">Security</h5>
                            <p class="card-text">Who should we contact regarding security matters?</p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="access-level" class="form-label">Mails</label>
                                    <input type="text" v-model="dataPage.mail_security" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-end mt-3">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search" :disabled="savedAction" @click="modifyContact">
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
            window.fetchFontendData('api/account/team-contact', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
        modifyContact() {}
    },
    created() {
        this.getContactData();
    },
    mounted() {
    }
};