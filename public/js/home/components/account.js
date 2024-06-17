var AccountSection = {
    template: `
    <div class="row">
        <div class="col-md-12">
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
                                    <input type="text" id="firstName" name="firstName" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Last name</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="access-level" class="form-label">Phone number</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Company</label>
                                    <input type="text" :disabled="true" id="company" name="company" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="access-level" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-end mt-3">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search" :disabled="savedAction" @click="modifyAccount">
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
        };
    },
    methods: {
        modifyAccount() {}
    },
    created() {
    },
    mounted() {
    }
};