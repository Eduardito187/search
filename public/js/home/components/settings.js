var SettingsSection = {
    template: `
    <div class="container mt-5">
        <div class="row">
            <h2>Organization Settings</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            General
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <router-link class="list-group-item list-group-item-action" to="/application">Applications</router-link>
                                <router-link class="list-group-item list-group-item-action" to="/infraestructura">Infrastructure</router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
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
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Team and Access
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <router-link class="list-group-item list-group-item-action" to="/keys">API Keys</router-link>
                                <router-link class="list-group-item list-group-item-action" to="/team">Team</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Personal Settings</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Personal Settings
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <router-link class="list-group-item list-group-item-action" to="/account">Account details</router-link>
                                <router-link class="list-group-item list-group-item-action" to="/notifications">Notificationss</router-link>
                                <router-link class="list-group-item list-group-item-action" to="/contacts">Contacts</router-link>
                                <router-link class="list-group-item list-group-item-action" to="/support">Support</router-link>
                            </div>
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