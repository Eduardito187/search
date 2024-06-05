var NotificationsSection = {
    template: `
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Weekly summary reports</h5>
                            <p class="card-text">Algolia sends weekly reports to keep you updated on the search activity and usage of your users and other such analytics. Recommended if you are interested in the performance of your search.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="weeklySummaryReports">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Usage alerts</h5>
                            <p class="card-text">Receive notifications when your application(s) reach 50%, 80% and 100% of your Free or Committed plan's usage quota.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="usageAlerts">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Billing</h5>
                            <p class="card-text">Receive invoices and notifications about payment/credit card issues. Recommended for application owners and people in charge of billing and invoicing.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="billing">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">AI</h5>
                            <p class="card-text">Algolia sends weekly notifications to keep you updated about your AI features activity. Recommended if you are interested in the impact of AI on your search performance.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="ai">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    mounted() {
        $('#weeklySummaryReports').on('change', function() {
            alert('Weekly summary reports switch toggled');
        });

        $('#usageAlerts').on('change', function() {
            alert('Usage alerts switch toggled');
        });

        $('#billing').on('change', function() {
            alert('Billing switch toggled');
        });

        $('#ai').on('change', function() {
            alert('AI switch toggled');
        });
    }
};