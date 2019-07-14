# Syntax eksekusi database;
php migration.php

# Exekusi api_native via terminal

# Script untuk eksekusi insert disbursement:
curl --request POST \
  --url http://localhost/api_native/disbursement/create.php \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --header 'Postman-Token: 1686d684-c01c-4a1d-af13-538ba79a7576' \
  --header 'cache-control: no-cache' \
  --data 'bank_code=bni&account_number=1234567890&amount=1000000&remark=test&undefined='


# Script untuk eksekusi update disbursement-> sesuaikan transaction_id dengan id disbursement
curl --request GET \
  --url 'http://localhost/api_native/disbursement/update.php?transaction_id=154660940' \
  --header 'Authorization: Basic SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo=' \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --header 'Postman-Token: 4ea5f88a-8885-468e-92d9-b7bfb38cffcc' \
  --header 'cache-control: no-cache' \
  --data 'username=setyocmuls&password=W0PsVNtqRFaIevon&undefined='
  
  
