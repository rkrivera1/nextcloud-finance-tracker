<?php
script('finance_tracker', 'script');
style('finance_tracker', 'style');
?>
<div id="content" class="app-financetracker nc-app">
    <div id="app-navigation-toggle" class="icon-menu"></div>
    
    <div id="app" class="finance-tracker-app">
        <div id="app-navigation" class="app-navigation">
            <ul class="with-icon">
                <li class="nav-item">
                    <a href="#" class="nav-icon-text" data-section="dashboard">
                        <span class="icon-home"></span>
                        <span class="nav-text"><?php p($l->t('Dashboard')); ?></span>
                    </a>
                </li>
                <?php print_unescaped($this->inc('navigation')); ?>
            </ul>
        </div>

        <div id="app-content" class="app-content">
            <div class="finance-sections">
                <!-- Dashboard Section -->
                <section id="dashboard-section" class="finance-section">
                    <div class="finance-section-content">
                        <h2><?php p($l->t('Financial Dashboard')); ?></h2>
                        <div class="dashboard-overview">
                            <div class="dashboard-card card">
                                <h3 class="card-title"><?php p($l->t('Account Summary')); ?></h3>
                                <div id="dashboard-accounts-summary" class="card-body">
                                    <div class="loading-indicator">
                                        <span class="icon-loading"></span>
                                        <?php p($l->t('Loading account summary...')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-card card">
                                <h3 class="card-title"><?php p($l->t('Recent Transactions')); ?></h3>
                                <div id="dashboard-recent-transactions" class="card-body">
                                    <div class="loading-indicator">
                                        <span class="icon-loading"></span>
                                        <?php p($l->t('Loading recent transactions...')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-card card">
                                <h3 class="card-title"><?php p($l->t('Budget Overview')); ?></h3>
                                <div id="dashboard-budget-overview" class="card-body">
                                    <div class="loading-indicator">
                                        <span class="icon-loading"></span>
                                        <?php p($l->t('Loading budget overview...')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Accounts Section -->
                <section id="accounts-section" class="finance-section" style="display: none;">
                    <div class="finance-section-content">
                        <h2><?php p($l->t('Accounts')); ?></h2>
                        <div class="accounts-list"></div>
                        <button id="add-account-btn" class="primary"><?php p($l->t('Add Account')); ?></button>
                    </div>
                </section>

                <!-- Transactions Section -->
                <section id="transactions-section" class="finance-section" style="display: none;">
                    <div class="finance-section-content">
                        <h2><?php p($l->t('Transactions')); ?></h2>
                        
                        <div class="transactions-header">
                            <div class="transactions-search">
                                <input 
                                    type="text" 
                                    id="transactions-search-input" 
                                    class="input-field"
                                    placeholder="<?php p($l->t('Search transactions...')); ?>"
                                >
                                <select id="transactions-search-filter" class="select-field">
                                    <option value="all"><?php p($l->t('All Fields')); ?></option>
                                    <option value="description"><?php p($l->t('Description')); ?></option>
                                    <option value="category"><?php p($l->t('Category')); ?></option>
                                    <option value="amount"><?php p($l->t('Amount')); ?></option>
                                    <option value="date"><?php p($l->t('Date')); ?></option>
                                </select>
                            </div>
                            
                            <div class="transactions-filters">
                                <select id="transaction-account-filter">
                                    <option value=""><?php p($l->t('All Accounts')); ?></option>
                                    <!-- Dynamically populated by JavaScript -->
                                </select>
                                <select id="transaction-category-filter">
                                    <option value=""><?php p($l->t('All Categories')); ?></option>
                                    <option value="groceries"><?php p($l->t('Groceries')); ?></option>
                                    <option value="dining"><?php p($l->t('Dining Out')); ?></option>
                                    <option value="entertainment"><?php p($l->t('Entertainment')); ?></option>
                                    <option value="utilities"><?php p($l->t('Utilities')); ?></option>
                                    <option value="transportation"><?php p($l->t('Transportation')); ?></option>
                                    <option value="other"><?php p($l->t('Other')); ?></option>
                                </select>
                                <input type="date" id="transaction-start-date" placeholder="<?php p($l->t('Start Date')); ?>">
                                <input type="date" id="transaction-end-date" placeholder="<?php p($l->t('End Date')); ?>">
                            </div>
                        </div>

                        <div class="transactions-content">
                            <table id="transactions-table" class="transactions-table">
                                <thead>
                                    <tr>
                                        <th><?php p($l->t('Date')); ?></th>
                                        <th><?php p($l->t('Description')); ?></th>
                                        <th><?php p($l->t('Category')); ?></th>
                                        <th><?php p($l->t('Amount')); ?></th>
                                        <th><?php p($l->t('Type')); ?></th>
                                        <th><?php p($l->t('Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="transactions-table-body">
                                    <!-- Transactions will be dynamically populated here -->
                                </tbody>
                            </table>
                            
                            <div id="no-transactions-found" class="no-results hidden">
                                <?php p($l->t('No transactions found matching your search.')); ?>
                            </div>
                        </div>
                        
                        <div class="transactions-summary">
                            <div class="summary-item">
                                <span><?php p($l->t('Total Income')); ?>:</span>
                                <span id="total-income">$0.00</span>
                            </div>
                            <div class="summary-item">
                                <span><?php p($l->t('Total Expenses')); ?>:</span>
                                <span id="total-expenses">$0.00</span>
                            </div>
                            <div class="summary-item">
                                <span><?php p($l->t('Net Balance')); ?>:</span>
                                <span id="net-balance">$0.00</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Investments Section -->
                <section id="investments-section" class="finance-section" style="display: none;">
                    <div class="finance-section-content">
                        <h2><?php p($l->t('Investments')); ?></h2>
                        
                        <div class="investments-header">
                            <div class="stock-search-container">
                                <input 
                                    type="text" 
                                    id="stock-search-input" 
                                    placeholder="<?php p($l->t('Search stocks by ticker or company name...')); ?>"
                                >
                                <button id="stock-search-btn" class="primary">
                                    <i class="fas fa-search"></i> <?php p($l->t('Search')); ?>
                                </button>
                            </div>
                            
                            <div class="investments-actions">
                                <button id="add-investment-btn" class="primary">
                                    <?php p($l->t('Add Investment')); ?>
                                </button>
                            </div>
                        </div>

                        <div id="stock-search-results" class="stock-search-results hidden">
                            <h3><?php p($l->t('Search Results')); ?></h3>
                            <table id="stock-search-results-table">
                                <thead>
                                    <tr>
                                        <th><?php p($l->t('Symbol')); ?></th>
                                        <th><?php p($l->t('Company Name')); ?></th>
                                        <th><?php p($l->t('Current Price')); ?></th>
                                        <th><?php p($l->t('Daily Change')); ?></th>
                                        <th><?php p($l->t('Performance')); ?></th>
                                        <th><?php p($l->t('Volume')); ?></th>
                                        <th><?php p($l->t('Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="stock-search-results-body">
                                    <!-- Dynamically populated -->
                                </tbody>
                            </table>
                        </div>

                        <div id="stock-details-modal" class="modal hidden">
                            <div class="modal-content">
                                <span class="close-modal">&times;</span>
                                <h2 id="stock-details-title"><?php p($l->t('Stock Details')); ?></h2>
                                <div id="stock-details-content">
                                    <!-- Detailed stock information will be populated here -->
                                </div>
                                <div class="stock-details-actions">
                                    <button id="add-to-portfolio-btn" class="primary">
                                        <?php p($l->t('Add to Portfolio')); ?>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="investments-content">
                            <table id="investments-table" class="investments-table">
                                <thead>
                                    <tr>
                                        <th><?php p($l->t('Symbol')); ?></th>
                                        <th><?php p($l->t('Name')); ?></th>
                                        <th><?php p($l->t('Quantity')); ?></th>
                                        <th><?php p($l->t('Purchase Price')); ?></th>
                                        <th><?php p($l->t('Current Price')); ?></th>
                                        <th><?php p($l->t('Daily Change')); ?></th>
                                        <th><?php p($l->t('Total Value')); ?></th>
                                        <th><?php p($l->t('Total Return')); ?></th>
                                        <th><?php p($l->t('Performance Metrics')); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="investments-table-body">
                                    <!-- Dynamically populated -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Budget Section -->
                <section id="budget-section" class="finance-section" style="display: none;">
                    <div class="finance-section-content">
                        <div class="budget-header">
                            <h2><?php p($l->t('Budget Management')); ?></h2>
                            <div class="budget-period-selector">
                                <select id="budget-period">
                                    <option value="monthly"><?php p($l->t('Monthly')); ?></option>
                                    <option value="yearly"><?php p($l->t('Yearly')); ?></option>
                                </select>
                                <input type="month" id="budget-month" value="<?php echo date('Y-m'); ?>">
                                <input type="number" id="budget-year" value="<?php echo date('Y'); ?>" min="2000" max="2100" style="display: none;">
                            </div>
                            <button id="add-budget-btn" class="primary">
                                <span class="icon-add"></span>
                                <?php p($l->t('Add Budget')); ?>
                            </button>
                        </div>

                        <div class="budget-overview">
                            <div class="budget-summary card">
                                <h3><?php p($l->t('Budget Summary')); ?></h3>
                                <div class="budget-stats">
                                    <div class="stat-item">
                                        <span class="label"><?php p($l->t('Total Budget')); ?></span>
                                        <span class="value" id="total-budget">$0.00</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="label"><?php p($l->t('Spent')); ?></span>
                                        <span class="value" id="total-spent">$0.00</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="label"><?php p($l->t('Remaining')); ?></span>
                                        <span class="value" id="total-remaining">$0.00</span>
                                    </div>
                                </div>
                                <div class="overall-progress">
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 0%"></div>
                                    </div>
                                    <span class="progress-text">0% used</span>
                                </div>
                            </div>
                        </div>

                        <div class="budget-categories">
                            <div class="categories-grid" id="budget-categories-grid">
                                <!-- Dynamically populated by JavaScript -->
                            </div>
                        </div>

                        <div class="budget-alerts">
                            <h3><?php p($l->t('Budget Alerts')); ?></h3>
                            <div id="budget-alerts-list">
                                <!-- Dynamically populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Reports Section -->
                <section id="reports-section" class="finance-section" style="display: none;">
                    <div class="finance-section-content">
                        <h2><?php p($l->t('Reports')); ?></h2>
                        <div class="reports-content">
                            <p><?php p($l->t('Generate and view financial reports')); ?></p>
                            
                            <div class="report-buttons">
                                <button id="generate-financial-overview-report" class="primary">
                                    <i class="fas fa-chart-pie"></i> <?php p($l->t('Financial Overview')); ?>
                                </button>
                                
                                <button id="generate-trend-analysis-report" class="secondary">
                                    <i class="fas fa-chart-line"></i> <?php p($l->t('Trend Analysis')); ?>
                                </button>
                                
                                <button id="generate-investment-report" class="secondary">
                                    <i class="fas fa-money-bill-trend-up"></i> <?php p($l->t('Investment Performance')); ?>
                                </button>
                                
                                <button id="generate-tax-projection-report" class="secondary">
                                    <i class="fas fa-file-invoice-dollar"></i> <?php p($l->t('Tax Projection')); ?>
                                </button>
                            </div>

                            <div id="report-export-options" class="report-export-options hidden">
                                <h3><?php p($l->t('Export Report')); ?></h3>
                                <select id="report-export-format">
                                    <option value="csv"><?php p($l->t('CSV')); ?></option>
                                    <option value="json"><?php p($l->t('JSON')); ?></option>
                                    <option value="pdf"><?php p($l->t('PDF')); ?></option>
                                </select>
                                <button id="export-report-btn" class="primary">
                                    <i class="fas fa-download"></i> <?php p($l->t('Export')); ?>
                                </button>
                            </div>

                            <div id="generated-report-container" class="generated-report">
                                <!-- Generated report will be displayed here -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<!-- Modals for Adding Items -->
<div id="modal-overlay" class="modal-overlay hidden">
    <!-- Account Modal -->
    <div id="account-modal" class="modal hidden">
        <div class="modal-content">
            <h2><?php p($l->t('Add Account')); ?></h2>
            <form id="account-form" class="form-group">
                <div class="form-group">
                    <label for="account-name"><?php p($l->t('Account Name')); ?></label>
                    <input type="text" 
                           id="account-name" 
                           class="input-field" 
                           placeholder="<?php p($l->t('Account Name')); ?>" 
                           required>
                </div>
                <select id="account-type">
                    <option value="checking"><?php p($l->t('Checking')); ?></option>
                    <option value="savings"><?php p($l->t('Savings')); ?></option>
                    <option value="credit"><?php p($l->t('Credit Card')); ?></option>
                </select>
                <input type="number" id="account-balance" placeholder="<?php p($l->t('Initial Balance')); ?>" step="0.01" required>
                <div class="modal-actions">
                    <button type="submit" class="primary"><?php p($l->t('Save')); ?></button>
                    <button type="button" class="cancel"><?php p($l->t('Cancel')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Transaction Modal -->
    <div id="transaction-modal" class="modal hidden">
        <div class="modal-content">
            <h2><?php p($l->t('Add Transaction')); ?></h2>
            <form id="transaction-form">
                <input type="text" id="transaction-description" placeholder="<?php p($l->t('Description')); ?>" required>
                <input type="number" id="transaction-amount" placeholder="<?php p($l->t('Amount')); ?>" step="0.01" required>
                <select id="transaction-type">
                    <option value="expense"><?php p($l->t('Expense')); ?></option>
                    <option value="income"><?php p($l->t('Income')); ?></option>
                </select>
                <select id="transaction-account">
                    <option value=""><?php p($l->t('Select Account')); ?></option>
                    <!-- This will be populated dynamically -->
                </select>
                <input type="date" id="transaction-date" required>
                <div class="modal-actions">
                    <button type="button" class="button cancel"><?php p($l->t('Cancel')); ?></button>
                    <button type="submit" class="primary"><?php p($l->t('Save')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Budget Modal -->
    <div id="budget-modal" class="modal hidden">
        <div class="modal-content">
            <h2><?php p($l->t('Add/Edit Budget')); ?></h2>
            <form id="budget-form">
                <div class="form-group">
                    <label for="budget-category"><?php p($l->t('Category')); ?></label>
                    <select id="budget-category" required>
                        <option value=""><?php p($l->t('Select Category')); ?></option>
                        <option value="housing"><?php p($l->t('Housing')); ?></option>
                        <option value="transportation"><?php p($l->t('Transportation')); ?></option>
                        <option value="groceries"><?php p($l->t('Groceries')); ?></option>
                        <option value="utilities"><?php p($l->t('Utilities')); ?></option>
                        <option value="healthcare"><?php p($l->t('Healthcare')); ?></option>
                        <option value="entertainment"><?php p($l->t('Entertainment')); ?></option>
                        <option value="dining"><?php p($l->t('Dining Out')); ?></option>
                        <option value="shopping"><?php p($l->t('Shopping')); ?></option>
                        <option value="savings"><?php p($l->t('Savings')); ?></option>
                        <option value="other"><?php p($l->t('Other')); ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="budget-amount"><?php p($l->t('Amount')); ?></label>
                    <input type="number" id="budget-amount" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="budget-alert-threshold"><?php p($l->t('Alert Threshold (%)')); ?></label>
                    <input type="number" id="budget-alert-threshold" min="1" max="100" value="80">
                </div>

                <div class="form-group">
                    <label for="budget-notes"><?php p($l->t('Notes')); ?></label>
                    <textarea id="budget-notes"></textarea>
                </div>

                <div class="form-group">
                    <label for="budget-goal"><?php p($l->t('Budget Goal')); ?></label>
                    <input type="number" id="budget-goal" min="0" step="0.01">
                    <select id="budget-goal-type">
                        <option value="saving"><?php p($l->t('Saving Target')); ?></option>
                        <option value="spending"><?php p($l->t('Spending Limit')); ?></option>
                    </select>
                    <input type="date" id="budget-goal-date" placeholder="<?php p($l->t('Target Date')); ?>">
                </div>

                <div class="modal-actions">
                    <button type="button" class="cancel"><?php p($l->t('Cancel')); ?></button>
                    <button type="submit" class="primary"><?php p($l->t('Save')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Investment Modal -->
    <div id="investment-modal" class="modal hidden">
        <div class="modal-content">
            <h2><?php p($l->t('Add Investment')); ?></h2>
            <form id="investment-form">
                <input type="text" id="investment-name" placeholder="<?php p($l->t('Investment Name')); ?>" required>
                <input type="text" id="investment-ticker" placeholder="<?php p($l->t('Ticker Symbol')); ?>">
                <input type="number" id="investment-shares" placeholder="<?php p($l->t('Number of Shares')); ?>" step="0.001" required>
                <input type="number" id="investment-price" placeholder="<?php p($l->t('Price per Share')); ?>" step="0.01" required>
                <div class="modal-actions">
                    <button type="submit" class="primary"><?php p($l->t('Save')); ?></button>
                    <button type="button" class="cancel"><?php p($l->t('Cancel')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal hidden">
        <div class="modal-content">
            <h2><?php p($l->t('Confirm Deletion')); ?></h2>
            <p id="delete-confirmation-message"></p>
            <div class="modal-actions">
                <button id="confirm-delete-btn" class="primary danger">
                    <?php p($l->t('Delete')); ?>
                </button>
                <button id="cancel-delete-btn" class="cancel">
                    <?php p($l->t('Cancel')); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add this after your other script includes -->
<script src="<?php print_unescaped(script_path('sampleData')); ?>"></script>
