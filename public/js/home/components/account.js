var AccountSection = {
    template: `
    <div class="row">
        <div v-if="dataPage != null" class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">Personal information</h5>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="access-level" class="form-label">First name</label>
                                    <input type="text" v-model="dataPage.first_name" id="firstName" name="firstName" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Last name</label>
                                    <input type="text" v-model="dataPage.last_name" id="lastName" name="lastName" class="form-control" />
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <label for="access-level" class="form-label">Phone number</label>
                                    <input type="text" v-model="dataPage.phone_number" id="phoneNumber" name="phoneNumber" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Company</label>
                                    <input type="text" v-model="dataPage.company" :disabled="true" id="company" name="company" class="form-control" />
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <label for="access-level" class="form-label">Email</label>
                                    <input type="text" v-model="dataPage.mail" id="email" name="email" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-end mt-3">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search" :disabled="savedAction" @click="modifyAccount">
                                <span>Save</span>
                                <div v-if="savedAction" class="spinner-border text-light size-loader" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title integration-title">Integración con Google</h5>
                        </div>
                        <div class="col-md-8 text-end">
                            <div class="col align-self-end">
                                <button type="button" class="btn-google" @click="redirectGoogle">
                                    <small>Google</small>
                                    <i class="fa fa-google"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title integration-title">Integración con GitHub</h5>
                        </div>
                        <div class="col-md-8 text-end">
                            <div class="col align-self-end">
                                <button type="button" class="btn-github" @click="redirectGitHub">
                                    <small>GitHub</small>
                                    <i class="fa fa-github"></i>
                                </button>
                            </div>
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
        getAccountData() {
            let self = this;
            window.fetchFontendData('api/account/my-account', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
        modifyAccount() {
        },
        redirectGitHub() {
            window.location.href = '/login/github';
        },
        redirectGoogle() {
            window.location.href = '/login/google';
        },
    },
    created() {
        this.getAccountData();
    },
    mounted() {
    }
};