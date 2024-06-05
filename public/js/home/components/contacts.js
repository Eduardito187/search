var ContactsSection = {
    template: `
    <div class="row">
        <div class="col-md-12">
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
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="access-level" class="form-label">Mails</label>
                                    <input type="text" class="form-control" />
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
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    mounted() {
    }
};