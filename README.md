# Base64
PHP base64 algorithm

I made this a couple years ago and improved the code.
 
```
encode() produces exactly the same result as base64_encode()
decode() produces exactly the same result as base64_decode()
```


## Usage: 
```php
echo encode("string to be encoded");          //c3RyaW5nIHRvIGJlIGVuY29kZWQ=
echo decode("c3RyaW5nIHRvIGJlIGVuY29kZWQ=");  //string to be encoded
```
