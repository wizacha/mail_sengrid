# Introduction
Small script to send an email with sendgrid

# Usage
```
composer install
php mailing.php \
    --content "<p>some content</p>" \
    --from example@example.com \
    --from-name "John doe d'example" \
    --subject "Email de test" \
    --sendgrid-key "api_key"
    --category "exemple01"
    --recipients-file ~/listings/big_listing.csv
```


