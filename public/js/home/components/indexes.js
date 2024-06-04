Vue.component('indexes-section', {
    template: `
    <div class="container-index">
        <div class="top-cards">
            <div class="card">
                <h2><i class="fa fa-money"></i> TODAY'S MONEY</h2>
                <p>$53,000</p>
                <span>+55% since yesterday</span>
            </div>
            <div class="card">
                <h2><i class="fa fa-users"></i> TODAY'S USERS</h2>
                <p>2,300</p>
                <span>+3% since last week</span>
            </div>
            <div class="card">
                <h2><i class="fa fa-user-plus"></i> NEW CLIENTS</h2>
                <p>+3,462</p>
                <span>-2% since last quarter</span>
            </div>
            <div class="card">
                <h2><i class="fa fa-shopping-cart"></i> SALES</h2>
                <p>$103,430</p>
                <span>+5% than last month</span>
            </div>
        </div>
        <div class="main-content">
            <div class="sales-overview">
                <h2>Sales Overview</h2>
                <canvas id="salesChart"></canvas>
            </div>
            <div class="get-started">
                <h2>Get started with Argon</h2>
                <p>There's nothing I really wanted to do in life that I wasn't able to get good at.</p>
            </div>
        </div>
        <div class="bottom-content">
            <div class="sales-by-country">
                <h2>Sales by Country</h2>
                <ul>
                    <li><span><i class="fa fa-flag"></i> United States:</span> 2500, $230,900, Bounce: 29.9%</li>
                    <li><span><i class="fa fa-flag"></i> Germany:</span> 3900, $440,000, Bounce: 40.22%</li>
                    <li><span><i class="fa fa-flag"></i> Other:</span> ..., ..., ...</li>
                </ul>
            </div>
            <div class="categories">
                <h2>Categories</h2>
                <ul>
                    <li><i class="fa fa-laptop"></i> Devices: 250 in stock, 346+ sold</li>
                    <li><i class="fa fa-ticket"></i> Tickets: 123 closed, 15 open</li>
                    <li><i class="fa fa-exclamation-triangle"></i> Error Logs: ...</li>
                </ul>
            </div>
        </div>
    </div>
    `
});