<?php
script('finance_tracker', 'admin');
style('finance_tracker', 'admin');
?>

<div id="finance-tracker-admin" class="section">
    <h2><?php p($l->t('Finance Tracker Settings')); ?></h2>
    
    <div>
        <label for="alpha-vantage-api-key">
            <?php p($l->t('Alpha Vantage API Key')); ?>
        </label>
        <input type="text" 
               id="alpha-vantage-api-key" 
               name="alpha_vantage_api_key"
               value="<?php p($_['alpha_vantage_api_key']); ?>"
               placeholder="<?php p($l->t('Enter your Alpha Vantage API key')); ?>"
        >
        <p class="settings-hint">
            <?php p($l->t('Get your API key at')); ?> 
            <a href="https://www.alphavantage.co/support/#api-key" target="_blank">Alpha Vantage</a>
        </p>
    </div>
</div> 