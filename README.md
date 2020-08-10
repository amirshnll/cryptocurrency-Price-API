# cryptocurrency-Price-API
cryptocurrency Price API - with PHP

### features
* html, css, bootstrap
* php
* api from nomics
* cache and updated time
* limit to show

#### for limit show : (index.php) - just need change line 30 $limit variable value
```
<?php
  $limit = 15;
  $counter = 0;
  foreach ($data as $key => $value) {
    $counter++;
		if($counter > $limit)
      break;
          
    # Echo Items
  }
?>
 
```

##### Shot
![cryptocurrency Price API](https://github.com/amirshnll/cryptocurrency-Price-API/raw/master/shot.png)
