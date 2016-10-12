Shopify DiscountApp
==========================
A very simple php-based shopify app to generate discount code on the fly.

Usage
-----
Just add the script to the folder you wish, change the credentials and add this short Javascript snippet to your page.

```javascript
$.ajax({
      type: 'GET',
      url: '//your-domain.com/path/app.php',
      data: 'createDiscount=1',
      dataType: 'jsonp',
      jsonpCallback: 'yeahCallbacks',
      cache: false,
      crossDomain: true,
      success: function(res) {

        // do something here

      },
      error: function(err) {
        // handle err
      }
    }).done(function() {
      	
        // or something here
    });
```