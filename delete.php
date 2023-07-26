<?php 
curl --request DELETE \
  'https://www.googleapis.com/drive/v2/files/trash?key=[YOUR_API_KEY]' \
  --header 'Authorization: Bearer [YOUR_ACCESS_TOKEN]' \
  --header 'Accept: application/json' \
  --compressed
  
  
  ?>