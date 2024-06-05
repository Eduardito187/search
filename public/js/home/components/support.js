var SupportSection = {
    template: `
    <div class="container">
        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Support</h5>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Algolia Support Access</h5>
                        <p class="card-text">In order to investigate a bug or improve relevance, it is sometimes useful to grant Algolia support access to the content of your indices.</p>
                        <div class="alert alert-info custom-alert" role="alert">
                            <i class="bi bi-info-circle"></i> Algolia cannot currently access your account.
                        </div>
                        <form id="support-access-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="access-level" class="form-label">Access level</label>
                                    <select class="form-select custom-select" id="access-level">
                                        <option value="read">read</option>
                                        <option value="write">write</option>
                                        <option value="admin">admin</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">Period</label>
                                    <select class="form-select custom-select" id="period">
                                        <option value="7">7 days</option>
                                        <option value="14">14 days</option>
                                        <option value="30">30 days</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    mounted() {
        $(document).ready(function(){
            $('#support-access-form').on('submit', function(event){
                event.preventDefault();
                alert('Form submitted!');
            });
        });      
    }
};