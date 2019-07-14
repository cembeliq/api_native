# Syntax eksekusi database;
php migration.php

# Exekusi api_native via terminal

# Script untuk eksekusi insert disbursement:
curl --request POST \
  --url http://localhost/api_native/disbursement/create.php \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --data 'bank_code=bni&account_number=1234567890&amount=1000000&remark=test'


# Script untuk eksekusi update disbursement-> sesuaikan transaction_id dengan id disbursement
curl --request GET \
  --url 'http://localhost/api_native/disbursement/update.php?transaction_id=154660940' \
  --header 'Content-Type: application/x-www-form-urlencoded'
  
  
