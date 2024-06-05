var SettingsSection = {
    template: `
    v class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Organization Settings</h2>
                <div class="card mb-3">
                    <div class="card-header">
                        General
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">Applications</a>
                            <a href="#" class="list-group-item list-group-item-action">Infrastructure</a>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Billing
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">Your plan and billing</a>
                            <a href="#" class="list-group-item list-group-item-action">Usage</a>
                            <a href="#" class="list-group-item list-group-item-action">Cost Management</a>
                            <a href="#" class="list-group-item list-group-item-action">Payment Details</a>
                            <a href="#" class="list-group-item list-group-item-action">Invoices</a>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Team and Access
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">API Keys</a>
                            <a href="#" class="list-group-item list-group-item-action">Team</a>
                        </div>
                    </div>
                </div>

                <h2>Personal Settings</h2>
                <div class="card mb-3">
                    <div class="card-header">
                        Personal Settings
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">Account details</a>
                            <a href="#" class="list-group-item list-group-item-action">Email notifications</a>
                            <a href="#" class="list-group-item list-group-item-action">Contacts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    mounted() {
        $(document).ready(function() {
            $('.list-group-item').on('click', function() {
                alert('This feature is currently not implemented.');
            });
        });        
    }
};